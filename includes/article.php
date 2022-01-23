<?php

/**
 * 
 * @param Object $conn Connection to the database
 * @param Object $id ID of the article to find
 * 
 * @return mixed An associative array containing the article with that ID or null if not found. 
 * 
 */

function getArticle($conn, $id, $columns = "*")
{

    $sql = "SELECT $columns FROM article WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}

/**
 * Validate the article properties
 * 
 * @param string $title Title of the article
 * 
 * @param string $content Content of the article 
 * 
 * @param string $published_at Published date and time of article yyyy-mm-dd hh:mm:ss if not blank
 * 
 * @return array of validation error messages
 */
function validateArticle($title, $content, $published_at)
{
    $errors = [];

    if ($title === "") {
        $errors[] = "Title is required";
    }

    if ($content === "") {
        $errors[] = "Content is required";
    }

    if ($published_at != '') {
        $dateTime =  date_create_from_format('Y-m-d H:i:s', $published_at);
        if ($dateTime  === false) {
            $errors[] = "Provided datetime is not valid";
        } else {

            $date_errors = date_get_last_errors();

            if ($date_errors['warning_count'] > 0) {
                $errors[] = "Not able to convert data";
            } else {
                $published_at = date_format($dateTime, "Y-m-d H:i:s");
            }
        }
    }

    return $errors;
}


/**
 * 
 * 
 * 
 */
function updateArticle($conn, $id, $title, $content, $published_at){

    $sql = "UPDATE article 
            SET  title = ?
            content = ?
            published_at = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}
