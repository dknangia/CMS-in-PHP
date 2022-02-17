<?php
require "includes/header.php";
$conn = require "includes/db.php";

$book = new Book();
$books = $book->GetAllBooks($conn);

// var_dump($books);
// exit;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $key = array_search($_POST["book_id"], array_column($books, 'id'));
    //var_dump($books[$key]);

    $_SESSION[Constants::BOOK_DETAILS_SESSION] = json_encode($books[$key]);
    header("Location: checkout.php");
}



?>


<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1>Books Listing</h1>
            <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A hic quam quisquam officia adipisci maiores dolorem cum sapiente repudiandae nostrum perspiciatis debitis saepe omnis temporibus, blanditiis quibusdam eaque perferendis corrupti..</p>

        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">

                <?php if (!empty($books)) : ?>

                    <?php foreach ($books as $key => $b) : ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <title><?= $b['name'] ?></title>
                                <img src="<?= "assets/img/uploads/" . $b['id'] . ".jpg" ?>" class=" bd-placeholder-img card-img-top" width="100%" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

                                <!-- <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text> -->
                                </svg>

                                <div class="card-body">
                                    <p class="card-text product-description-text"><strong>Description:</strong> <?= $b['description'] ?></p>
                                    <p class="card-text"><strong>Price:</strong> $<?= $b['price'] ?></p>
                                    <p class="card-text"><strong>ISBN:</strong> <?= $b['isbn'] ?></p>
                                    <p class="card-text"><strong>Year:</strong> <?= $b['Year'] ?></p>
                                    <p class="card-text"><strong>Category:</strong> <?= $b['category'] ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <form method="post">
                                                <input type="hidden" value="<?= $b['id'] ?>" name="book_id" ?>
                                                <input type="submit" <?php if ($b['inventory_count'] < 1) : ?> disabled <?php endif; ?> class="btn btn-sm btn-outline-secondary" value="Checkout">
                                            </form>
                                        </div>
                                        <small class="text-muted">Inventory : <?= $b['inventory_count'] ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

</main>


<?php
require "includes/footer.php"
?>