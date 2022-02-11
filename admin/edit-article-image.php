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
        //More better way to check the mime type of uploaded file. 
        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if (!in_array($mime_type, $mime_types)) {
            throw new Exception(("Invalid file type"));
        }

        $pathinfo = pathinfo($_FILES['file']['name']);


        $base = $pathinfo['filename'];
        $base = mb_substr($base, 0, 200);

        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

        $filename = $base . "." . $pathinfo['extension'];

        $destination = "../uploads/" . $filename;
        $iCounter = 1;
        while (file_exists($destination)) {
            $destination =  "../uploads/" . $base .  "-" . $iCounter . "." . $pathinfo['extension'];
            $iCounter++;
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

            $previous_image = $article->image_file;
            var_dump($previous_image);

            if ($article->setImageFile($conn, $filename)) {
                if ($previous_image) {
                    unlink("../uploads/{$previous_image}");
                }
                URL::redirect("/admin/article.php?id={$article->id}");
            }

            echo "file uploaded successfully";
        } else {
            throw new Exception("Unable to move uploaded file");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

require "../includes/header.php";
?>


<h1>Edit article Image</h1>
<?php if ($article->image_file) : ?>
    <img src="/uploads/<?= $article->image_file ?>" />

    <p>
        <a href="delete-article-image.php?id=<?= $article->id ?>">Delete</a>
    </p>

<?php endif; ?>
<form method="post" enctype="multipart/form-data">
    <p>
        <label for="file">Image file</label>
        <input type="file" name="file" id="file">
    </p>
    <input type="submit" value="Submit" name="submit">

</form>

<?php require "../includes/footer.php" ?>