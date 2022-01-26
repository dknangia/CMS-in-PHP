<?php 
require "Item.php";

$myObject = new Item("Product X123R", "A big product for your house.");

echo $myObject->getName();

// var_dump($myObject);
