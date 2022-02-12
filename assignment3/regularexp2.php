<?php
/*
    2. Create an HTML form that takes user input and write a regex pattern in PHP to check if the string meets the following rules: 
        a. It consists only of letters, digits and hyphens
        b. It consists of 2 or more “groups”, where the “groups” are delimited by a period 
        c. The final group consists of two or more letters (no numbers or hyphens)
        d. Hyphens cannot appear in pairs and cannot appear as the first or last character in a group
Some valid examples: abc.def.gh or abc-def.gh or 123.345.abc  3 marks

load this php file in the browser, then look at source code. (ctrl-u)
*/

function rgx($regex, $string) {
  echo "-------------------------\n";
  echo (preg_match($regex, $string, $array) == 0 ? "NO" : "YES"); 
  
  echo " '$regex' IN STRING: '$string'\n" . "<br>";
}

$regex = "/^([a-zA-F0-9-?]){1,}.?([a-zA-F]){2,}/";

echo "\n=========================\nBelow should be YES:\n";
rgx($regex, "abc.gh");
rgx($regex, "abc.def.gh");
rgx($regex, "abc.def.gh");
rgx($regex, "abc-def.gh"); 
rgx($regex, "123.345.abc");
rgx($regex, "123.345.123.abc");
rgx($regex, "ABC.def.gh");

echo "\n=========================\nBelow should be NO:\n";

//consists only of letters, digits and hyphens
rgx($regex, "!!!ab&&c.def.gh");  //Fails because there are characters which are not letters, digits and hyphens

//It consists of 2 or more “groups”, where the “groups” are delimited by a period
rgx($regex, "abc");   //Fails because only one group

//The final group consists of two or more letters (no numbers or hyphens)
rgx($regex, "abc.s"); //Fails because only one letter in final group
rgx($regex, "abc.123"); //Fails because numbers in final group
rgx($regex, "abc.a-"); //Fails because hyphens not allowed in final group


//Hyphens cannot appear in pairs and cannot appear as the first or last character in a group: 
rgx($regex, "abc--def.gh"); //Fails because hyphen in a pair
rgx($regex, "-abcef.gh");  //Fails because hyphen is first character in a group
rgx($regex, "abc-.gh");  //Fails because hyphen is last character in a group
rgx($regex, "123.345-.abc"); //Fails because hyphen is last character in a group
