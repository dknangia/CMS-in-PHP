<?php

require "../includes/init.php";
$conn = require "../includes/db.php";

Auth::requireLogin();

$articles = Article::getAllArticles($conn);

?>

<?php require "../includes/header.php" ?>

<?php
if (Auth::isloggedIn()) : ?>

    <p>You are logged in, <a href="/logout.php">Logout</a></p>
    <p><a href="/new-article.php">New Article</a></p>
<?php else : ?>
    <p>You are NOT logged in, <a href="/login.php">Login</a></p>
<?php endif; ?>

<?php if (empty($articles)) : ?>
    <p>No records found</p>
<?php else : ?>
    <h2>Administration</h2>
    <table>
        <thead>
            <th>Titile</th>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) : ?>

                <tr>
                    <td>
                        <h4><?php echo "<a href=\"\article.php?id={$article['id']}\">"
                                . htmlspecialchars($article['title']) . "</a>"; ?></h4>
                    </td>
                </tr>              
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?php require "../includes/footer.php" ?>