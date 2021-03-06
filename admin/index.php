<?php

require "../includes/init.php";
Auth::requireLogin();
$conn = require "../includes/db.php";

$total = Article::getTotal($conn);
$paginator = new Paginator($_GET['page'] ?? 1, 4, $total);

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

?>

<?php require "../includes/header.php" ?>




<h2>Administratoin</h2>
<p><a href="/admin/new-article.php">New Article</a></p>


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
                        <h4><?php echo "<a href=\"article.php?id={$article['id']}\">"
                                . htmlspecialchars($article['title']) . "</a>"; ?></h4>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php require "../includes/pagination.php" ?>

<?php endif; ?>
<?php require "../includes/footer.php" ?>