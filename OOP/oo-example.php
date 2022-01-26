<?php 
require "Item.php";

$myObject = new Item("Product X123R", "A big product for your house.");
echo $myObject->name ; 
echo $myObject->description; 

//Dynamic property 
$myObject->price = 0.25; 

echo $myObject->getName();

// var_dump($myObject);
