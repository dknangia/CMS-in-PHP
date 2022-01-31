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
     * @return mixed An object of this class.
     * 
     */

    public static function getArticleById($conn, $id, $columns = "*")
    {

        $sql = "SELECT $columns FROM article WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id,  PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }


    public function updateArticleByID($conn)
    {
        $sql = "UPDATE article 
                SET title = :title, 
                    content = :content, 
                    published_at = :published_at
                WHERE 
                    Id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

        //Complex statement 
        $stmt->bindValue(
            ':published_at',
            $this->published_at == '' ? null : $this->published_at,
            $this->published_at == '' ? PDO::PARAM_NULL : PDO::PARAM_STR
        );


        return $stmt->execute();
    }
}
