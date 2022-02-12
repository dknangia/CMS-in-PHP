<?php
$username  = "";
$password  = "";
$age = "";
$city = "";
$country = "";

$errorMessages = [];

function validateAge(int $age = 0)
{
    if ($age >= 18 && $age <= 120) {
        return true;
    }
    return false;
}

function validatePassword(string $password)
{
    if (
        strlen($password) > 6
        && (strpos($password, "@")
            || strpos($password, "*")
            || strpos($password, "$"))
    ) {

        return true;
    }
    return false;
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // var_dump($_POST);

    if (!empty($_POST['username'])) {
        $username = htmlspecialchars($_POST['username']);
    } else {
        $errorMessages[] = "Username is required";
    }
    if (!empty($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
        if (!validatePassword($password)) {
            $errorMessages[] = "Password complexity not met";
        }
    } else {
        $errorMessages[] = "Password is required";
    }
    if (!empty($_POST['age']) && is_numeric($_POST['age'])) {
        $age = htmlspecialchars($_POST['age']);
        if (!validateAge($age)) {
            $errorMessages[] = "Age should be between 18 and 120";
        }
    } else {
        $errorMessages[] = "Age is required";
    }
    if (!empty($_POST['city'])) {
        $city = htmlspecialchars($_POST['city']);
    } else {
        $errorMessages[] = "City is required";
    }
    if (!empty($_POST['country'])) {
        $country = htmlspecialchars($_POST['country']);
    } else {
        $errorMessages[] = "Country is required";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit page</title>
</head>

<body>
    <div>
        <?php if (!empty($errorMessages)) : ?>
            <ul>
                <?php foreach ($errorMessages as $key => $value) : ?>
                    <li style="color: red;"><?= $value ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <h2>Success</h2>
            <ul>
                <li>Username : <?= $username ?></li>
                <li>Password : <?= $password ?></li>
                <li>Age : <?= $age ?></li>
                <li>City : <?= $city ?></li>
                <li>Country : <?= $country ?></li>
            </ul>
        <?php endif; ?>
    </div>
</body>

</html>