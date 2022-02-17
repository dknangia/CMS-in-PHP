<?php require "includes/init.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Book Store : Kuber</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <link href="assets/css/cover.css" rel="stylesheet">
    <link href="assets/css/album.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="text-center">
    <div class="d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Book Store</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="index.php">Home</a>
                    <a class="nav-link" href="aboutus.php">About Us</a>
                    <?php if (Auth::isLoggedIn()) : ?>
                        <a class="nav-link" href="product-listing.php">Product Listing</a>
                    <?php endif; ?>

                    <a class="nav-link" href="contact.php">Contact</a>
                    <?php if (Auth::isLoggedIn()) : ?>
                        <a class="nav-link" href="logout.php">Logout</a>
                    <?php endif; ?>

                </nav>
            </div>
        </header>