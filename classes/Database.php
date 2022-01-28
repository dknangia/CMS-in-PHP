<?php 
/**
 * Database 
 * 
 * A connection to the database server
 */
class Database{

    /**
     * Get the database connection 
     * 
     * @return PDO object connection to the database server 
     */
    public function getConnection(){
        $db_host = "localhost";
        $db_name = "cms";
        $db_user = "cms_www";
        $db_pass = "Welcome@12";
        
        $dsn="mysql:host=" . $db_host . ";dbname=". $db_name. ";charset=utf8";

        return $conn = new PDO($dsn, $db_user, $db_pass); 

    
    }
}