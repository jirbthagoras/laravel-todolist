<?php

namespace App\Services;

interface UserService
{
    function login(string $username, string $password): bool;
}
