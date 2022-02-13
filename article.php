<?php

require "includes/init.php";

$conn = require "includes/db.php";

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET['id'];
    $article = Article::getWithCategories($conn, $id);
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
                <h2><?php echo htmlspecialchars($article[0]['title']); ?></h2>
                <?php if ($article[0]['category_name'] != null) : ?>
                    <p>Categories:
                        <?php foreach ($article as $value) : ?>
                            <?= $value['category_name'] ?>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>
                <?php if ($article[0]['image_file']) : ?>
                    <img src="/uploads/<?= $article[0]['image_file'] ?>" />
                <?php endif; ?>
                <p><?php echo htmlspecialchars($article[0]['content']); ?></p>
            </article>
        </li>
    </ul>
<?php endif; ?>
<?php require "includes/footer.php" ?>