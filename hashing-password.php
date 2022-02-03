<?php 

$password = 'secret1'; 

// $hash = password_hash($password, PASSWORD_DEFAULT); 

// echo $hash;

$hash = '$2y$10$O2Avk5FXUKjhMkMbEvG.nuoyIUdBUUihyIAJS2BvPgEKtML3HVSFO'; 

var_dump(password_verify($password, $hash)); 