<?php

// In order to delete the cookie just set the time in negative e.g. -36000
setcookie('example', "hello", time() + 60 * 60 * 24 * 2, "/");

echo "Cookie is set <br/>";

var_dump($_COOKIE['example']);
