<?php

require "includes/init.php";

$conn = require "includes/db.php";

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET['id'];
    $article = Article::getArticleById($conn, $id);
} else {
    $article = null;
}
require "includes/header.php";
?>


<?php if (!$article) : ?>
    <p>No record is found</p>
<?php else : ?>
    <ul>
        <li>
            <article>
                <h2><?php echo htmlspecialchars($article->title); ?></h2>
                <?php if ($article->image_file) : ?>
                    <img src="/uploads/<?= $article->image_file ?>" />
                <?php endif; ?>
                <p><?php echo htmlspecialchars($article->content); ?></p>
            </article>
        </li>
    </ul>
<?php endif; ?>
<?php require "includes/footer.php" ?>