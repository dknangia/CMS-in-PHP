<?php

require "../includes/init.php";
Auth::requireLogin();
$conn = require "../includes/db.php";

Auth::requireLogin();

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET['id'];
    $article = Article::getArticleById($conn, $id);
    $categories = Category::getAll($conn);

    $category_id = array_column($article->getCategories($conn), 'id');
    var_dump($category_id);

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

    $category_id = $_POST['category'] ?? [];

    if ($article->updateArticleByID($conn)) {
        $article->setCategories($conn, $category_id);
        Url::redirect("/admin/article.php?id=$article->id");
    }
}

require "../includes/header.php";
?>


<h1>New article</h1>

<?php require "includes/article-form.php" ?>

<?php require "../includes/footer.php" ?>