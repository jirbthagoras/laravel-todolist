<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);

    }


    public function testTrue()
    {
        self::assertTrue(true);

    }

    public function testLoginSuccess()
    {

        self::assertTrue($this->userService->login("jabriel", "secret"));

    }

    public function testLoginNotFound()
    {

        self::assertFalse($this->userService->login("bukanjabriel", "secret"));

    }

    public function testLoginFailed()
    {

        self::assertFalse($this->userService->login("jabriel", "failed"));

    }


}
