<?php

namespace App\Providers;

use App\Services\TodoListService;
use App\Services\TodoListServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodolistServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        TodoListService::class => TodoListServiceImpl::class,
    ];

    public function provides(): array
    {
        return [
            TodoListService::class
        ];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
