<?php

require "includes/init.php";
$conn = require "includes/db.php";



$conn = require "includes/db.php";

$total = Article::getTotal($conn); 
$paginator = new Paginator($_GET['page'] ?? 1, 2, $total);

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

?>

<?php require "includes/header.php" ?>



<?php if (empty($articles)) : ?>
    <p>No records found</p>
<?php else : ?>
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

    <?php require "includes/pagination.php" ?>
<?php endif; ?>
<?php require "includes/footer.php" ?>