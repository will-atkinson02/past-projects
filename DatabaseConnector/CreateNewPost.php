<?php

declare(strict_types=1);

require_once 'src/Services/DatabaseConnector.php';
require_once 'src/Models/PostsModel.php';
require_once 'src/Entities/Post.php';

$db = DatabaseConnector::connect();

$postsModel = new PostsModel($db);

session_start();

if(isset($_POST['title'], $_POST['content'], $_POST['image'], $_POST['category'])) {
    $postsModel->createPost($_POST['title'], $_POST['content'], $_POST['image'], (int)$_POST['category'], $_SESSION['uid']);
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <h2>Create a new post</h2>
    <form class="create-post" method="post">

        <label for="addTitle">Title:</label>
        <input type="text" id="addTitle" name="title"/>
        <br />

        <label for="addCategory">Content:</label>
        <textarea type="text" id="addCategory" name="content"></textarea>
        <br />

        <label for="addImage">Image URL:</label>
        <input type="text" id="addImage" name="image"/>
        <br />

        <label for="addCategory">Choose a category:</label>
        <select id="addCategory" name="category">
            <option value="1">News</option>
            <option value="2">Tech</option>
            <option value="3">Science</option>
            <option value="4">Nature</option>
            <option value="5">Gossip</option>
        </select>
        <br />
        <input type="submit" value="Submit" />
    </form>
</body>
</html>


