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
    public $image_file;
    public $errors = [];


    public static function getAllArticles($conn)
    {
        $sql = "SELECT * FROM article ORDER BY title";

        $results = $conn->query($sql);
        return $results->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getPage($conn, $limit, $offset)
    {
        $sql = "SELECT * 
                FROM article 
                ORDER BY ID 
                LIMIT :limit
                OFFSET :offset";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        //$stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        $sql = "SELECT $columns 
                FROM article                 
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id,  PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }

    /**
     * Fetch 
     * 
     */
    public static function getWithCategories($conn, $id)
    {
        $sql = "SELECT *, c.name as category_name
                FROM article a
                LEFT JOIN article_category ac
                    ON a.id = ac.article_id
                LEFT JOIN category c
                    ON c.id = ac.category_id
                WHERE a.id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getCategories($conn)
    {
        $sql = "SELECT category.*
                FROM category
                JOIN article_category
                ON category.id = article_category.category_id
                WHERE article_id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    /**
     * Update the categories of the article
     * 
     * @param object $conn MySQL connection 
     * @param array $ids  Arrays of article categories id. 
     * 
     * @return null
     * 
     */
    public function setCategories($conn, $ids)
    {
        if ($ids) {
            $sql = "INSERT IGNORE INTO article_category (article_id, category_id)
                    VALUES ({$this->id}, :category_id)";
            $stmt = $conn->prepare($sql);
            foreach ($ids as $id) {
                $stmt->bindValue(":category_id", $id, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }

    /**
     * Update article by ID, the ID will be taken from the object
     * 
     * @param object $conn Connection string.
     */
    public function updateArticleByID($conn)
    {
        if ($this->validate()) {
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
        } else {
            return false;
        }
    }


    /**
     * Delete article based on id; 
     * 
     * @return bool return true on successfull execution of the command, and return false on failure. 
     */
    public function deteleArticleById($conn)
    {

        $sql = "DELETE FROM article 
                    WHERE 
                    Id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);

        return ($stmt->execute());
    }


    /**
     * Create new article in database 
     * 
     * @return boolean return true on success and false on failure
     */

    public function insertNewArticle($conn)
    {
        if ($this->validate()) {
            $sql = "INSERT INTO article (title, content, published_at)
                VALUES (:title, 
                        :content, 
                        :published_at)";

            $stmt = $conn->prepare($sql);


            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            $stmt->bindValue(
                ':published_at',
                $this->published_at == '' ? null : $this->published_at,
                $this->published_at == '' ? PDO::PARAM_NULL : PDO::PARAM_STR
            );

            if ($stmt->execute()) {
                $this->id =  $conn->lastInsertId();
                return true;
            } else {
                false;
            }
        }
        return false;
    }


    /**
     * Validate the article properties
     *      * 
     * @return array of validation error messages
     */
    protected function validate()
    {
        if ($this->title === "") {
            $this->errors[] = "Title is required";
        }

        if ($this->content === "") {
            $this->errors[] = "Content is required";
        }

        if ($this->published_at != '') {
            $dateTime =  date_create_from_format('Y-m-d H:i:s', $this->published_at);
            if ($dateTime  === false) {
                $this->errors[] = "Provided datetime is not valid";
            } else {

                $date_errors = date_get_last_errors();

                if ($date_errors['warning_count'] > 0) {
                    $this->errors[] = "Not able to convert data";
                } else {
                    $published_at = date_format($dateTime, "Y-m-d H:i:s");
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * Get total number of records in article table
     * 
     * @return int Count of the records in table
     */
    public static function getTotal($conn)
    {
        return $conn->query("SELECT COUNT(1) FROM Article")->fetchColumn();
    }


    /** 
     * Function to bind image file with the article
     * 
     * @param object $conn mysql connection
     * @param string $filename Image filename  
     * 
     * @return boolean 
     */
    public function setImageFile($conn,  $filename)
    {

        $sql = "UPDATE article 
                    SET image_file = :filename                 
                    WHERE Id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':filename', $filename, $filename == null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        return $stmt->execute();
    }
}
