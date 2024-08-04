<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListControllerTest extends TestCase
{
    public function testTodolist()
    {

        $this->withSession([
            "user" => 'jabriel',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'makan jeruk',
                ]
            ]
        ])
            ->get('/todolist')
            ->assertSeeText('makan jeruk')
            ->assertStatus(200);

    }

    public function testAddTodo()
    {

        $this->withSession([
            'user' => 'jabriel',
        ])
            ->post('/todolist', ['todo' => 'makan jeruk'])
            ->assertSeeText('makan memk')
            ->assertStatus(200);

    }


}
