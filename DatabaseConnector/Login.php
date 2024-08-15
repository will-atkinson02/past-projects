<?php

declare(strict_types=1);

require_once 'src/Services/DatabaseConnector.php';
require_once 'src/Services/DisplayPostsService.php';
require_once 'src/Models/PostsModel.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Entities/Post.php';
require_once 'src/Entities/User.php';

$db = DatabaseConnector::connect();

$usersModel = new UsersModel($db);

if(isset($_POST['username'], $_POST['password'] )) {
    $users = $usersModel->checkUserExists($_POST['username']);
    if ($users === false) {
        throw new Exception("Sorry, this account doesn't exist!");
    }

    // check password is correct
    $passwordVerify = password_verify($_POST['password'], $users->getPassword());

    if (!$passwordVerify) {
        throw new Exception("Incorrect password!");
    }

    session_start();

    $_SESSION['loggedIn'] = true;
    $_SESSION['uid'] = $users->getId();

    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<pre>
<form method="post">
    <label for="username" >Enter Username:</label>
    <input id="username" type="text" name="username" />

    <label for="password" >Enter Password:</label>
    <input id="password" type="password" name="password" />

    <input type="submit" value="Login" />

</form>
</body>
</html>
