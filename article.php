<?php

require "includes/database.php";

$conn = getDB();

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $sql = "SELECT * 
            FROM article 
            WHERE ID = {$_GET['id']} 
            ORDER BY title";

    $results = mysqli_query($conn, $sql);

    if ($results === false) {
        echo mysqli_error($conn);
    } else {

        $article = mysqli_fetch_assoc($results);
    }
} else {
    $article = null;
}
require "includes/header.php";
?>


<?php if ($article === null) : ?>
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
<?php endif; ?>
<?php require "includes/footer.php" ?>