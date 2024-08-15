<?php

declare(strict_types=1);

require_once 'src/Services/DatabaseConnector.php';
require_once 'src/Services/DisplayPostsService.php';
require_once 'src/Models/PostsModel.php';
require_once 'src/Entities/Post.php';

$db = DatabaseConnector::connect();

$postsModel = new PostsModel($db);

$posts = $postsModel->getAllPosts();

session_start();

if(isset($_POST['logout'])) {
    $_SESSION['loggedIn'] = false;
    session_destroy();
    header("Location: index.php");
}

if(isset($_SESSION['loggedIn'])) {
    $addNewPost = "<div class='add-new-container'><a href='CreateNewPost.php'> <span>+</span> Add new post</a></div>";
    $logout = "<form method='post'><input type='submit' name='logout' value='logout'/></form>";
} else {
    $login = "<a href='Login.php'><input type='submit' value='Login'/></a>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<header>
    <h2>Welcome to my website</h2>
    <div class="buttons">
    <?php

    if(isset($_SESSION['loggedIn'])) {
        echo $addNewPost;
    }

    if(isset($_SESSION['loggedIn'])) {
        echo $logout;
    } else {
        echo $login;
        echo "<a href='Registration.php'><input type='submit' value='Sign up'/></a>";
    }
    ?>
    </div>
</header>
<body>
<h3>Here are my posts:</h3>
<?php

echo DisplayPostsService::showPostTitles($posts);

?>
</body>
</html>
