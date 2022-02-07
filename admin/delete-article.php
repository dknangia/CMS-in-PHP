<?php

require "../includes/init.php";
Auth::requireLogin();
$conn = require "../includes/db.php";

$article = null;

if (isset($_GET['id'])) {

    $id = htmlspecialchars($_GET['id']);


    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET['id'];
        $article = Article::getArticleById($conn, $id, "id");


        if (!$article) {

            die("No article found with this id");
        }
    } else {
        $article = null;
        die("id is not supplied, no article is found");
    }




    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($errors)) {
            if ($article->deteleArticleById($conn)) {
                Url::redirect("/admin");
            }
        }
    }
}

require "../includes/header.php";

?>
<h2>Delete article</h2>
<form method="POST">

    <p>Are you sure want to delete?</p>
    <button>Delete</button> | <a href="article.php?id=<?= $article->id; ?>">Cancel</a>

</form>
<?php require "../includes/footer.php" ?>