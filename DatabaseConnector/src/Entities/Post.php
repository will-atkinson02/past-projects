<?php

declare(strict_types=1);

class Post {
    private int $id;
    private string $title;
    private string $image;
    private string $content;
    private string $name;
    private string $username;


    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}