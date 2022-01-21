<?php

require "includes/database.php";
$errors = [];

// Form variables 
$title = '';
$content = '';
$published_at = '';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $published_at = htmlspecialchars($_POST['published_at']);

    if ($title === "") {
        $errors[] = "Title is required";
    } 

    if ($content === "") {
        $errors[] = "Content is required";
    } 
    
    if (empty($errors)) {
        $conn = getDB();
        $sql = "INSERT INTO article (title, content, published_at)
            VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {

            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);
                echo "Inserted record with ID : $id";
            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}
require "includes/header.php";
?>


<h1>New article</h1>
<?php if (!empty($errors)) : ?>
    <ul>
        <?php foreach ($errors as $key => $value) : ?>
            <li><?= $value ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title" value="<?= $title; ?>">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="5" cols="7" placeholder="Content"><?= $content; ?></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime" id="published_at" name="published_at" placeholder="Published date" value="<?= $published_at; ?>">
    </div>
    <button>Submit</button>
</form>

<?php require "includes/footer.php" ?>