<?php

/**
 * Database 
 * 
 * A connection to the database server
 */
class Database
{

    /**
     * Get the database connection 
     * 
     * @return PDO object connection to the database server 
     */
    public function getConnection()
    {
        $db_host = "localhost";
        $db_name = "book_store";
        $db_user = "root";
        $db_pass = "";

        $dsn = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";

        try {
            $conn = new PDO($dsn, $db_user, $db_pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (Throwable $th) {
            echo $th->getMessage();
            exit;
        }
    }
}
