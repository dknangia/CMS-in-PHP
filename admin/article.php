<?php

require "../includes/init.php";
Auth::requireLogin();
$conn = require "../includes/db.php";

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET['id'];
    $article = Article::getArticleById($conn, $id);
} else {
    $article = null;
}
require "../includes/header.php";
?>


<?php if (!$article) : ?>
    <p>No record is found</p>
<?php else : ?>
    <ul>
        <li>
            <article>
                <h2><?php echo htmlspecialchars($article->title); ?></h2>
                <p><?php echo htmlspecialchars($article->content); ?></p>
            </article>
        </li>
    </ul>
    <p> <a href="<?= "./edit-article.php?id=$id" ?>">Edit</a> 

    </p>
    <p>
        <a href="<?= "./delete-article.php?id=$id" ?>">Delete</a>
    </p>
    <p>
        <a href="<?= "./edit-article-image.php?id=$article->id" ?>">Edit Image</a>
    </p>
<?php endif; ?>
<?php require "../includes/footer.php" ?>