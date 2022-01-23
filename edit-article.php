<?php

require "includes/database.php";
require "includes/article.php";

$conn = getDB();

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET['id'];
    $article = getArticle($conn, $id);

    $title = '';
    $content = '';
    $published_at = '';

    if ($article !== null) {

        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    } else {
        die("No article found with this id");
    }
} else {
    $article = null;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = htmlspecialchars($_GET['id']);
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if (empty($errors)) {
        $conn = getDB();
        $sql = "UPDATE  article
                SET title = ?
                , content  = ?
                , published_at = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {

            if (empty($published_at)) {
                $published_at = null;
            }

            mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);

            if (mysqli_stmt_execute($stmt)) {
               
                $protocol = '';
                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                    $protocol = 'https';
                } else {
                    $protocol = 'http';
                }

                //Redirect the user to article details page
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

<?php require "includes/article-form.php" ?>

<?php require "includes/footer.php" ?>