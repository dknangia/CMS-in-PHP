<?php

require "classes/Database.php";
require "classes/Article.php";


$db = new Database();
$conn = $db->getConnection();

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
                <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                <p><?php echo htmlspecialchars($article['content']); ?></p>
            </article>
        </li>
    </ul>
    <p> <a href="<?= "./edit-article.php?id=$id" ?>">Edit</a> |
        <a href="<?= "./delete-article.php?id=$id" ?>">Delete</a>
    </p>
<?php endif; ?>
<?php require "includes/footer.php" ?>