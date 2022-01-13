<?php

/*PHP is type free language, you can save anytype in your variable, it is the responsiblity of the developer to take care of casting */
$stringType = "Sample String";

$stringType2 = "false";

$boolType = false; //This is not same as $stringType2, as this is a boolean type and the earlier one is String. 

$integer = 12;


// var_dump can be used to check the type of variable
var_dump($integer, $stringType);


$articles = ["First post", "Second post"];

// For each loop for array $articles
// foreach ($articles as $article) {

//     echo $article;
// }


echo count($articles);
$stringLiteral = "";
for ($i = 0; $i < count($articles); $i++) {
    $stringLiteral = $stringLiteral . (string)$articles[$i];

    $stringLiteral  = $stringLiteral . (string) $i == (count($articles) - 1) ? ". " : ", ";
    echo $stringLiteral;
}

// If conditions

$a = 10;
$b = 12;
?>
<br>
<?php
if ($a > $b) {
    echo "{$a} is bigger than {$b}";
} else {
    echo "{$b} is bigger than {$a}";
}

if (false) {
    echo "stop";
} else {
    echo "go";
}
?>