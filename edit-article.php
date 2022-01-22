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

    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if (empty($errors)) {
        //Update 
    }


}

require "includes/header.php";
?>


<h1>New article</h1>

<?php require "includes/article-form.php" ?>

<?php require "includes/footer.php" ?>