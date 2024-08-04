<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPageSuccess()
    {

        $this->get("/login")
            ->assertSeeText("Login");

    }

    public function testOnlyGuestMiddlwareForMember()
    {

        $this->withSession([
            'user' => 'jirb'
        ])
            ->get('/login')
            ->assertRedirect("/");

    }

    public function testOnlyGuestMiddlewareForGuest()
    {

        $this->get('/login')
            ->assertSeeText('Login');

    }

    public function testOnlyMemberMiddlewareForGuest()
    {

        $this->get('/logout')
            ->assertSeeText('/');

        $this->get('/login')
            ->assertSeeText('Login');

    }

    public function testOnlyMemberMiddlewareForMember()
    {

        $this->withSession([
            'user' => 'jirb'
        ])
            ->get('/logout')
            ->assertSessionMissing('user');

    }

    public function testLoginSuccess()
    {

        $this->post("/login", [
            'user' => "jabriel",
            'password' => "secret"
        ])
            ->assertRedirect("/");

    }

    public function testLoginFailed()
    {

        $this->post("/login", [
            'user' => "jabriel",
            'password' => "mmek"
        ])
            ->assertSeeText("User Or Password Incorrect");

    }

    public function testLogout()
    {

        $this->withSession([
            'user' => "jabriel",
        ])
            ->get('logout')
            ->assertRedirect("/")
            ->assertSessionMissing('user');

    }


}
