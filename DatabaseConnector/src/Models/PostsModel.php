<?php

declare(strict_types=1);

class PostsModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllPosts(): array
    {
        $query = $this->db->prepare('SELECT `posts`.`id`, `posts`.`title`, `posts`.`content`,`posts`.`image`, 
       `categories`.`name`, `users`.`username` FROM `posts` INNER JOIN `users` ON `posts`.`user_id` = `users`.`id`
	    INNER JOIN `categories` ON `posts`.`category_id` = `categories`.`id`;');
        $query->setFetchMode(PDO::FETCH_CLASS, Post::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function getPostById(int $id): Post
    {
        $query = $this->db->prepare('SELECT `id`, `title`, `image`, `content` FROM `posts` WHERE `posts`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, Post::class);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    public function createPost(string $title, string $content, string $image, int $categoryId, int $userId): bool
    {
        $query = $this->db->prepare('INSERT INTO `posts` (`title`, `content`, `image`, `category_id`, `user_id`) 
        VALUES (:title, :content, :image, :category_id, :user_id);');
        return $query->execute([
            'title' => $title,
            'content' => $content,
            'image' => $image,
            'category_id' => $categoryId,
            'user_id' => $userId
        ]);
    }

}