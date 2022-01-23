<?php

require "includes/database.php";
require "includes/article.php";
require "includes/url.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = getDB();

    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET['id'];
        $article = getArticle($conn, $id, "id");

        $id = -1;

        if ($article !== null) {

            $id = $article['id'];
        } else {
            die("No article found with this id");
        }
    } else {
        $article = null;
        die("id is not supplied, no article is found");
    }



    $id = htmlspecialchars($_GET['id']);

    if (empty($errors)) {
        $conn = getDB();
        $sql = "DELETE FROM article
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {

            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                redirect("/articles.php");
                exit;
            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}

require "includes/header.php";

?>
<h2>Delete article</h2>
<form method="POST">

    <p>Are you sure want to delete?</p>
    <button>Delete</button> | <a href="/article.php?id=<?php if (isset($_GET['id'])) {
                                                            echo $_GET['id'];
                                                        }; ?>">Cancel</a>

</form>
<?php require "includes/footer.php" ?>