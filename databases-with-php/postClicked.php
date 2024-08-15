<?php


echo $_GET['id'];

$db = new PDO('mysql:host=db;dbname=socials', 'root', 'password');

function showPosts($db) {
    $id = $_GET['id'];
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $query = $db->prepare('SELECT `posts`.`id`, `posts`.`title`, `posts`.`content`,`posts`.`image`, `categories`.`name`, `users`.`username`
 	FROM `posts`
	INNER JOIN `users`
		ON `posts`.`user_id` = `users`.`id`
	INNER JOIN `categories`
		ON `posts`.`category_id` = `categories`.`id`
	WHERE `posts`.`id` = :id;');
    $query->execute(['id' => $id]);
    $post = $query->fetch();
    return "
        <h2>{$post['title']}</h2>
        <img src='{$post['image']}' />
        <p>{$post['content']}</p>
        <p>{$post['name']}</p>
        <p>{$post['username']}</p>
        <br />
        ";
}
echo showPosts($db);