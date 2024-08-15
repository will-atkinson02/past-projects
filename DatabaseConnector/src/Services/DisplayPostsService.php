<?php

declare(strict_types=1);

class DisplayPostsService {
    public static function showPostTitles(array $posts): string {
        $displayPostsTitles = '';
        foreach ($posts as $post) {
            $displayPostsTitles .= "<div><a href='IndividualPost.php?id={$post->getId()}'>{$post->getTitle()}</a></div>";
        }
        return $displayPostsTitles;
    }

    public static function showIndividualPost(Post $post): string
    {
    return "
        <div>
        <h2>{$post->getTitle()}</h2>
        <img src='{$post->getImage()}' alt='' />
        <p>{$post->getContent()}</p>
        </div>
        ";
    }
}