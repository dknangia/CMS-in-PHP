<?php
require "includes/database.php";
require "includes/auth.php";

session_start();

$conn = getDB();

$sql = "SELECT * FROM article ORDER BY title";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {

    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>

<?php require "includes/header.php" ?>

<?php
if (isloggedIn()) : ?>

    <p>You are logged in, <a href="/logout.php">Logout</a></p>
    <p><a href="/new-article.php">New Article</a></p>
<?php else : ?>
    <p>You are NOT logged in, <a href="/login.php">Login</a></p>
<?php endif; ?>

<?php if (empty($articles)) : ?>
    <p>No records found</p>
<?php else : ?>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>
                    <h2><?php echo "<a href=\"\article.php?id={$article['id']}\">"
                            . htmlspecialchars($article['title']) . "</a>"; ?></h2>
                    <p><?php echo htmlspecialchars($article['content']); ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php require "includes/footer.php" ?>