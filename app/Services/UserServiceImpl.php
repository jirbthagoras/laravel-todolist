<?php

namespace App\Services;

class UserServiceImpl implements UserService
{

    private array $users = [
        "jabriel" => "secret",
        "jabingan" => "memek"
    ];

    function login(string $username, string $password): bool
    {

        if(!isset($this->users[$username]))
        {
            return false;
        }

        $correctPassword = $this->users[$username];

        return $password == $correctPassword;

    }

}
