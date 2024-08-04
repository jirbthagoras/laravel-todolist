<?php

namespace Tests\Feature;

use App\Services\TodoListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

class TodoListServiceTest extends TestCase
{

    private TodoListService $todoListService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todoListService = $this->app->make(TodoListService::class);

    }

    public function testTrue()
    {

        self::assertNotNull($this->todoListService);

    }

    public function testSaveTodo()
    {

        $this->todoListService->saveTodo('1', 'Makan Jeruk');

        $todolist = Session::get('todolist');

        foreach ($todolist as $value) {
        self::assertEquals('Makan Jeruk', $value['todo']);
        self::assertEquals('1', $value['id']);
        }

    }

    public function testGetTodoEmpty()
    {

        self::assertEquals([], $this->todoListService->getTodo());

    }

    public function testGetTodoArray()
    {

        $this->todoListService->saveTodo('1', 'Makan Jeruk');

        $todolist = $this->todoListService->getTodo();

        foreach ($todolist as $value) {
            self::assertEquals('Makan Jeruk', $value['todo']);
            self::assertEquals('1', $value['id']);
        }

    }

    public function testRemoveTodo()
    {

        $this->todoListService->saveTodo('1', 'Makan Jeruk');
        $this->todoListService->saveTodo('2', 'Berak');

        $this->todoListService->removeTodo('2');

        self::assertEquals(1, sizeof($this->todoListService->getTodo()));


    }


}
