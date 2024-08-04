<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);

Route::get('/template', function () {

    return view('template');

});

Route::controller(\App\Http\Controllers\UserController::class)->group(function () {

    Route::get("/login", "Login")->middleware(\App\Http\Middleware\OnlyGuestMiddlware::class);
    Route::post("/login", "DoLogin")->middleware(\App\Http\Middleware\OnlyGuestMiddlware::class);
    Route::post("/logout", "DoLogout")->middleware(\App\Http\Middleware\OnlyMemberMiddleware::class);

});

Route::controller(\App\Http\Controllers\TodoListController::class)
    ->middleware(\App\Http\Middleware\OnlyMemberMiddleware::class)
    ->group(function () {
        Route::get('/todolist', 'todolist');
        Route::post('/todolist', 'addTodo');
        Route::post('/todolist/{id}/delete', 'removeTodo');
    });
