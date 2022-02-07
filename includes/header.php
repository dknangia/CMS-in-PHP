<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>My Blog</h1>
    </header>
    <nav>
        <ul>
            <li><a href="/articles.php">Home</a></li>
            <?php if (Auth::isloggedIn()) : ?>
                <li><a href="/admin/">Admin</a></li>
                <li><a href="/logout.php">Log out</a></li>
            <?php else : ?>
                <li><a href="/login.php">Log in</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <main>