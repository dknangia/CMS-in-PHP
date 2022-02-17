<?php

class Book
{
    public $Name;
    public $ISBN;
    public $Price;
    public $Description;
    public $Author;
    public $PublishedYear;
    public $isEnabled;
    public $Category;


    public static function GetAllBooks($conn)
    {
        $sql = "SELECT b.id
                        , b.name
                        , b.isbn
                        , b.price
                        , b.description
                        , b.author
                        , b.published_year as 'Year'
                        , b.is_enabled
                        , c.name AS category
                        , bi.inventory_count      
                        FROM books b
                    INNER JOIN Book_inventory bi
                        ON bi.book_id = b.id
                    INNER JOIN book_category bc
                        ON b.id = bc.book_id
                    INNER JOIN category c
                        ON c.id = bc.category_id
                    ORDER BY b.id";

        $results = $conn->query($sql);
        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
}
