<?php

// require "includes/database.php";

// if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
//     $sql = "SELECT * 
//             FROM article 
//             WHERE ID = {$_GET['id']} 
//             ORDER BY title";

//     $results = mysqli_query($conn, $sql);

//     if ($results === false) {
//         echo mysqli_error($conn);
//     } else {

//         $article = mysqli_fetch_assoc($results);
//     }
// } else {
//     $article = null;
// }
require "includes/header.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    var_dump($_POST);
}



?>


<h1>New article</h1>
<form method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="5" cols="7" placeholder="Content"></textarea>
    </div>

    <div>
        <label for="publication">Publication date and time</label>
        <input type="datetime" id="publishedOn" name="publishedOn" placeholder="Published date">
    </div>
    <button>Submit</button>
</form>

<?php require "includes/footer.php" ?>