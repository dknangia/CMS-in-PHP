<?php
class Category{
    public $id;
    public $category_name;


    /**
     * Return all the categories from DB
     * 
     * @param object $conn DB connection
     * 
     * @return array result set in Category object array 
     */
    public static function getAll($conn)
    {
        $sql = "SELECT * FROM category ORDER BY name";

        $results = $conn->query($sql);
        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
}