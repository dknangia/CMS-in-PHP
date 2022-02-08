<?php

require "../includes/init.php";
Auth::requireLogin();
$conn = require "../includes/db.php";

Auth::requireLogin();

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET['id'];
    $article = Article::getArticleById($conn, $id);

    if (!$article) {
        die("No article found with this id");
    }
} else {
    $article = null;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    var_dump($_FILES);

}

require "../includes/header.php";
?>


<h1>Edit article Image</h1>

<form method="post" enctype="multipart/form-data">
    <p>
        <label for="file">Image file</label>
        <input type="file" name="file" id="file">
    </p>
    <input type="submit" value="Submit" name="submit">

</form>

<?php require "../includes/footer.php" ?>