<?php 
require "Item.php";
require "book.php";

$my_item = new Item(); 
$my_item->name = "TV"; 

echo $my_item->getListingDescription();

echo "<br>";

$my_item = null;
$my_item = new Book(); 
$my_item->name = "Hamilton"; 
$my_item->author = "David brown";

echo $my_item->getListingDescription();