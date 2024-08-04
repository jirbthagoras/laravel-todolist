<?php

namespace App\Http\Controllers;

use App\Services\TodoListService;
use Illuminate\Http\Request;

class TodoListController extends Controller
{

    private TodoListService $todoListService;

    /**
     * @param TodoListService $todoListService
     */
    public function __construct(TodoListService $todoListService)
    {
        $this->todoListService = $todoListService;
    }


    public function todolist(Request $request)
    {

        $todolist = $this->todoListService->getTodo();

        return response()->view('todolist.todolist', [
            'title' => 'Todolist',
            'todolist' => $todolist,
        ]);
    }

    public function addTodo(Request $request)
    {

        $todo = $request->input('todo');

        $this->todoListService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodoListController::class, 'todolist']);

    }

    public function removeTodo(Request $request, string $id)
    {

        $this->todoListService->removeTodo($id);
        return redirect()->action([TodoListController::class, 'todolist']);

    }
}
