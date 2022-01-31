<?php

/**
 * Artile : Class regarding entiry called Articles, it contiains all the method and functions related to Articles. 
 * 
 */
class Article
{
    public $id; 
    public $title; 
    public $content; 
    public $published_at;

    public static function getAllArticles($conn)
    {
        $sql = "SELECT * FROM article ORDER BY title";

        $results = $conn->query($sql);
        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
 * 
 * @param Object $conn Connection to the database
 * @param Object $id ID of the article to find
 * 
 * @return mixed An associative array containing the article with that ID or null if not found. 
 * 
 */

public static function getArticleById($conn, $id, $columns = "*")
{

    $sql = "SELECT $columns FROM article WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':id', $id,  PDO::PARAM_INT);

    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

}
