<?php

require "classes/Database.php";
require "includes/url.php";
require "classes/Article.php";
require "classes/Auth.php"; 
require "classes/URL.php";

$db = new Database();
$conn = $db->getConnection();

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET['id'];
    $article = Article::getArticleById($conn, $id);

    if (!$article) {
        die("No article found with this id");
    }
} else {
    $article = null;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $article->id = htmlspecialchars($_GET['id']);
    $article->title = htmlspecialchars($_POST['title']);
    $article->content = htmlspecialchars($_POST['content']);
    $article->published_at = $_POST['published_at'];

    if ($article->updateArticleByID($conn)) {
        Url::redirect("/article.php?id=$article->id");
    }
}

require "includes/header.php";
?>


<h1>New article</h1>

<?php require "includes/article-form.php" ?>

<?php require "includes/footer.php" ?>