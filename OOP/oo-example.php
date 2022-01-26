<?php 
require "Item.php";


var_dump(Item::$count);

$myObject = new Item();

$myObject->setName("Product X123"); 
echo $myObject->getName();

var_dump(Item::$count);

$secondObject = new Item();

var_dump(Item::$count);

echo "<br>"; 
echo Item::readingCountValue();
