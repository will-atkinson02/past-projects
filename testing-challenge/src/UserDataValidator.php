<?php

declare(strict_types=1);

class UserDataValidator {
    public function validateEmail(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public function validateUsername(string $username): bool
    {
        if (strlen($username) > 20) {
            return false;
        }

        if (strlen($username) < 5) {
            return false;
        }

        if (str_contains($username, ' ')) {
            return false;
        }

        return true;
    }

    public function validatePassword(string $password): bool
    {
        if (strlen($password) < 8) {
            return false;
        }

        return true;
    }

    public function validateAge(int $age): bool
    {
        if($age < 16) {
            return false;
        }

        return true;
    }

    public function validateType(string $type): bool
    {
        $types = ['admin', 'editor', 'user'];

        $typeLower = strtolower($type);

        if (!in_array($typeLower, $types)) {
            return false;
        }

        return true;
    }

}