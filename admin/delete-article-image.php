<?php

require "../includes/init.php";
Auth::requireLogin();
$conn = require "../includes/db.php";

Auth::requireLogin();

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

            $previous_image = $article->image_file;
  

            if ($article->setImageFile($conn, null)) {
                if ($previous_image) {
                    unlink("../uploads/{$previous_image}");
                }
                URL::redirect("/admin/article.php?id={$article->id}");
            }
}

require "../includes/header.php";
?>


<h1>Delete article Image</h1>
<?php if ($article->image_file) : ?>
    <img src="/uploads/<?= $article->image_file ?>" />
<?php endif; ?>
<form method="post" enctype="multipart/form-data">
    <p>
        <input type="submit" value="Delete" name="submit">
    </p>
    <p>
        <a href="/article.php?<?= $article->id ?>">Cancel</a>
    </p>


</form>

<?php require "../includes/footer.php" ?>