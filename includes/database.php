<?php
/**
 * Get the db connection
 * 
 * @param : none
 * 
 * @return : Database connection 
 */
function getDB()
{

    $db_host = "localhost";
    $db_name = "cms";
    $db_user = "cms_www";
    $db_pass = "Welcome@12";
    $articles = array();
    $errorMessage = "";



    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
}
