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

    // var_dump($_FILES);

    try {
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:

                break;

            case UPLOAD_ERR_INI_SIZE:
                throw new Exception("Invalid file size");
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception("No file uploaded");
                break;

            default:
                throw new Exception("An error occured");
                break;
        }

        if ($_FILES['file']['size'] > 1000 * 1000) {
            throw new Exception("File is too large");
        }

        $mime_type = ['image/gif', 'image/png', 'image/jpeg'];

        if (!in_array($_FILES['file']['type'], $mime_type)) {
            throw new Exception(("Invalid file type"));
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
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