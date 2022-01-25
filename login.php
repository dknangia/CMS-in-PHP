<?php
session_start();
require "includes/url.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['username'] == "dknangia" && $_POST['password'] === "1234") {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
        redirect("/articles.php");
        exit;
    } else {

        $error = "Incorrect login";
    }
}

?>

<?php include "includes/header.php"; ?>

<h2>Login</h2>
<?php if (!empty($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>
<form method="POST">
    <p>
        <lable for="username">User name</lable>
        <input type="text" name="username">
    </p>
    <p>
        <lable for="password">Password</lable>
        <input type="text" name="password">
    </p>
    <p>
        <button>Login</button>
    </p>
</form>

<?php include "includes/footer.php" ?>