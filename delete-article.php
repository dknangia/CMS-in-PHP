<?php

require "includes/database.php";
require "includes/article.php";
require "includes/url.php";

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
    die("id is not supplied, no article is found");
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = htmlspecialchars($_GET['id']);

    if (empty($errors)) {
        $conn = getDB();
        $sql = "DELETE FROM article
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {

            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                redirect("/articles.php");
                exit;
            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}

require "includes/header.php";
?>
<?php require "includes/footer.php" ?>