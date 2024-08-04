<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGuest()
    {
        $this->get("/")
            ->assertRedirect('login');
    }

    public function testMember()
    {
        $this->withSession([
            'user' => 'jirb'
        ])
            ->get("/")
            ->assertRedirect('/todolist');
    }
}
