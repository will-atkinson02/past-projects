<?php

$db = new PDO('mysql:host=db;dbname=socials', 'root', 'password');

// Posts
function getPosts($db) {
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $query = $db->prepare('SELECT `posts`.`id`, `posts`.`title`, `posts`.`content`,`posts`.`image`, 
       `categories`.`name`, `users`.`username` FROM `posts` INNER JOIN `users` ON `posts`.`user_id` = `users`.`id`
	    INNER JOIN `categories` ON `posts`.`category_id` = `categories`.`id`;');
    $query->execute();
    $posts = $query->fetchAll();
    return $posts;
}
;
function showPosts($posts) {
    $displayPosts = '';
    foreach ($posts as $post) {
        $displayPosts .= "<a href='postClicked.php?id={$post['id']}'>{$post['title']}</a><br />";
    }
    return $displayPosts;
}
echo showPosts(getPosts($db));

// Categories
function showCategories($db) {
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $query = $db->prepare('SELECT `id`, `name` FROM `categories`;');
    $query->execute();
    $categories = $query->fetchAll();
    $displayCategories = '';
    foreach ($categories as $category) {
        $displayCategories .= "<li>{$category['name']}</li>";
    }
    return "<ul>$displayCategories</ul>";
}
echo showCategories($db);



// Users
function showUsers($db) {
    $query = $db->prepare('SELECT `id`, `username` FROM `users`;');
    $query->execute();
    $users = $query->fetchAll();
    $displayUsers = '';
    foreach ($users as $user) {
        $displayUsers .= "<li>{$user['id']} - {$user['username']}</li>";
    }
    return "<ul>$displayUsers</ul>";
}

echo showUsers($db);

?>

<a href="form.php">Add to our categories!</a>






