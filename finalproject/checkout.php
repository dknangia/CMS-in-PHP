<?php
require "includes/header.php";
$conn = require "includes/db.php";

if (isset($_SESSION[Constants::BOOK_DETAILS_SESSION])) {
    $b = json_decode($_SESSION[Constants::BOOK_DETAILS_SESSION], true);
} else {
    echo "<h1 style=\"color:red;\">Session is expired, please go back to BOOKS listing page and select an item.</h1>";
    die;
}
$errorMessage = [];
$firstName = "";
$lastName = "";
$address = "";
$address2 = "";
$city = "";
$state = "";
$zip = "";
$creditcard = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    //var_dump($_POST);

    if (!empty($_POST['firstname'])) {
        $firstName = htmlspecialchars($_POST['firstname']);
    } else {
        $errorMessage[] = "First name is required";
    }

    if (!empty($_POST['lastname'])) {
        $$lastName = htmlspecialchars($_POST['lastname']);
    } else {
        $errorMessage[] = "Last name is required";
    }

    if (!empty($_POST['address'])) {
        $address = htmlspecialchars($_POST['address']);
    } else {
        $errorMessage[] = "Address name is required";
    }

    if (!empty($_POST['address2'])) {
        $address2 = htmlspecialchars($_POST['address2']);
    } else {
        $errorMessage[] = "Address2 name is required";
    }

    if (!empty($_POST['city'])) {
        $city = htmlspecialchars($_POST['city']);
    } else {
        $errorMessage[] = "City name is required";
    }

    if (!empty($_POST['state'])) {
        $state = htmlspecialchars($_POST['state']);
    } else {
        $errorMessage[] = "State name is required";
    }

    if (!empty($_POST['zip'])) {
        $zip = htmlspecialchars($_POST['zip']);
    } else {
        $errorMessage[] = "Zip name is required";
    }

    if (!empty($_POST['creditcard'])) {
        $creditcard = htmlspecialchars($_POST['creditcard']);
    } else {
        $errorMessage[] = "Credit Card name is required";
    }

    if (empty($errorMessage)) {

        $order = new Order();
        $order->firstName = $firstName;
        $order->lastName = $lastName;
        $order->address = $address;
        $order->address2 = $address2;
        $order->city = $city;
        $order->state = $state;
        $order->zip = $zip;
        $order->bookId = $b['id'];
        $order->price = $b['price'];

        $order_id = 0;
        if ($order_id = $order->saveOrder($conn)) {
            header("Location: thankyou.php?order_id={$order_id}");
        }
    }
}



?>

<main role="main" class="inner extra-cover cover">
    <h1 class="cover-heading">Checkout form</h1>
    <p class="lead">Please fill the below form to complete your order.</p>
    <?php if (!empty($errorMessage)) : ?>
        <ul class="alert alert-danger">
            <?php foreach ($errorMessage as $key => $value) : ?>
                <li><?= $value ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="album py-5">
        <div class="container">
            <div class="row">
                <?php if (!empty($b)) : ?>

                    <div class="col-md-12">
                        <div class="card mb-4 shadow-sm">
                            <title><?= $b[0]->name ?></title>
                            <img src="<?= "assets/img/uploads/" . $b['id'] . ".jpg" ?>" class=" bd-placeholder-img card-img-top-checkout" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

                            <div class="card-body">
                                <p class="card-text product-description-text-checkoutpage"><strong>Description:</strong> <?= $b['description']; ?></p>
                                <p class="card-text"><strong>Price:</strong> $<?= $b['price'] ?></p>
                                <p class="card-text"><strong>ISBN:</strong> <?= $b['isbn'] ?></p>
                                <p class="card-text"><strong>Year:</strong> <?= $b['Year'] ?></p>
                                <p class="card-text"><strong>Category:</strong> <?= $b['category'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <form method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?= $firstName ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?= $lastName ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?= $address ?>">
        </div>
        <div class="form-group">
            <label for="address2">Address 2</label>
            <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment, studio, or floor" value="<?= $address2 ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" id="city" value="<?= $city ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="state">State</label>
                <select id="state" name="state" class="form-control">
                    <option selected>Choose...</option>
                    <option value="OC">Quebec (QC)</option>
                    <option value="ON">Ontario (ON)</option>
                    <option value="BC">British Columbia (BC)</option>
                    <option value="NS">Nova Scotia (NS)</option>
                    <option value="MB">Manitoba (MB)</option>
                    <option value="NB">New Brunswick (NB)</option>
                    <option value="PE">Prince Edward Island (PE)</option>
                    <option value="SK">Saskatchewan (SK)</option>
                    <option value="AB">Alberta (AB)</option>
                    <option value="NL">Newfoundland and Labrador (NL)</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="zip" id="zip" value="<?= $zip ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="creditcard">Credit Card Number </label>
                <input type="text" class="form-control" id="creditcard" name="creditcard" placeholder="4929639605974091" value="<?= $creditcard ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Checkout</button>
        <a href="product-listing.php" class="btn btn-secondary">Cancel</a>
    </form>
</main>

<?php
require "includes/footer.php"
?>