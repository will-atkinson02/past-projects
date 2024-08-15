<?php

declare(strict_types=1);

require_once 'src/Services/DatabaseConnector.php';
require_once 'src/Services/DisplayPostsService.php';
require_once 'src/Models/PostsModel.php';
require_once 'src/Entities/Post.php';

session_start();

$db = DatabaseConnector::connect();

$postsModel = new PostsModel($db);

$id = (int)$_GET['id'];

$post = $postsModel->getPostById($id);

var_dump($_GET);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New</title>
</head>
<body>
<?php
echo DisplayPostsService::showIndividualPost($post);
?>
</body>
</html>

