<?php

require "includes/database.php";
$errors = [];

// Form variables 
$title = '';
$content = '';
$published_at = '';



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $published_at = $_POST['published_at'];

    if ($title === "") {
        $errors[] = "Title is required";
    }

    if ($content === "") {
        $errors[] = "Content is required";
    }

    if ($published_at != '') {
        $dateTime =  date_create_from_format('Y-m-d H:i:s', $published_at);
        if ($dateTime  === false) {
            $errors[] = "Provided datetime is not valid";
        } else {

            $date_errors = date_get_last_errors();

            if ($date_errors['warning_count'] > 0) {
                $errors[] = "Not able to convert data";
            } else {
                $published_at = date_format($dateTime, "Y-m-d H:i:s");
            }
        }
    }

    if (empty($errors)) {
        $conn = getDB();
        $sql = "INSERT INTO article (title, content, published_at)
            VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {

            if (empty($published_at)) {
                $published_at = null;
            }

            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);
                echo "Inserted record with ID : $id";

                $protocol = '';

                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                    $protocol = 'https';
                } else {
                    $protocol = 'http';
                }

                //Redirect the user to another page
                header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/article.php?id=$id");
                exit;
            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}
require "includes/header.php";
?>


<h1>New article</h1>

<?php require "includes/article-form.php"?>

<?php require "includes/footer.php" ?>