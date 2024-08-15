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

if(isset($_POST['username'], $_POST['password'])) {
    $users = $usersModel->checkUserExists($_POST['username']);
    if (!$users === false) {
        throw new Exception('Sorry, this username is taken!');
    }

    if ($_POST['password'] != $_POST['password2'] ) {
        throw new Exception("Password doesn't match!");
    }
    $safePassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $usersModel->createUser($_POST['username'], $safePassword);
    header("Location: Login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New</title>
</head>
<body>
<pre>
<h2>Sign up</h2>
<form method="post">
    <label for="username" >Choose Username:</label>
    <input id="username" type="text" name="username" />

    <label for="password" >Choose Password:</label>
    <input id="password" type="password" name="password" />

    <label for="password" >Confirm Password:</label>
    <input id="password" type="password" name="password2" />

    <input type="submit" value="Register" />

</form>
</body>
</html>
