<?php

$errorMessage = "";
$pattern = "/^(0x|0X)?[a-fA-F0-9]+$/";
$userInput = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_POST['userInput'] && strlen($_POST['userInput']) == 2)) {
        $userInput = $_POST['userInput'];
        if (preg_match($pattern, $_POST['userInput'], $matches) == 0) {

            $errorMessage = "'{$userInput}' is not a valid hexadecimal number";
        }
    } else {
        $errorMessage = "User input must be only 2 characters long";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regular Expressions</title>
</head>

<body>
    <form method="post">
        <?php if ($errorMessage != "") : ?>
            <h4 style="color: red;"><?= $errorMessage ?></h4>
        <?php else : ?>
            <h4 style="color: green;">'<?= $userInput ?>' is a valid hexadecimal</h4>
        <?php endif; ?>

        <div>
            <p>
                <label for="userInput">User Input:</label><br />
                <input type="userInput" id="userInput" name="userInput" placeholder="Enter hexadecimal">
            </p>
        </div>
        <div>
            <input type="submit" id="submit" value="Submit">
        </div>
    </form>
</body>

</html>