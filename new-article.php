<?php

require "includes/init.php";




if (!Auth::isloggedIn()) {

    die("Unauthorized");
}

$article = new Article();

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $db = new Database();
    $conn = $db->getConnection();



    $article->title = htmlspecialchars($_POST['title']);
    $article->content = htmlspecialchars($_POST['content']);
    $article->published_at = $_POST['published_at'];


    if ($article->insertNewArticle($conn)) {

        URl::redirect("/article.php?id=$article->id");
    }
}
?>
<?php require "includes/header.php"; ?>


<h1>New article</h1>

<?php require "includes/article-form.php" ?>

<?php require "includes/footer.php"; ?>