<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(PermissionMiddleware::using('user:access'))
        ->prefix('/user')->group(function(){
        Route::get('/',App\Livewire\User\Index::class)->name('users.index');
        Route::get('/create',App\Livewire\User\Create::class)->name('users.create');
        Route::get('/edit/{user}',App\Livewire\User\Edit::class)->name('users.edit');
        Route::get('/{user}',App\Livewire\User\Show::class)->name('users.show');
    });

    Route::middleware(PermissionMiddleware::using('provider:access'))
        ->prefix('/provider')->group(function(){
        Route::get('/',App\Livewire\Provider\Index::class)->name('providers.index');
        Route::get('/create',App\Livewire\Provider\Create::class)->name('providers.create');
        Route::get('/edit/{provider}',App\Livewire\Provider\Edit::class)->name('providers.edit');
        Route::get('/{provider}',App\Livewire\Provider\Show::class)->name('providers.show');
    });

    Route::middleware(PermissionMiddleware::using('article:access'))
        ->prefix('/article')->group(function(){
        Route::get('/',App\Livewire\Article\Index::class)->name('articles.index');
        Route::get('/create',App\Livewire\Article\Create::class)->name('articles.create');
        Route::get('/edit/{article}',App\Livewire\Article\Edit::class)->name('articles.edit');
        Route::get('/{article}',App\Livewire\Article\Show::class)->name('articles.show');
    });

    Route::middleware(PermissionMiddleware::using('category:access'))
        ->prefix('/category')->group(function(){
        Route::get('/',App\Livewire\Category\Index::class)->name('categories.index');
        Route::get('/create',App\Livewire\Category\Create::class)->name('categories.create');
        Route::get('/edit/{category}',App\Livewire\Category\Edit::class)->name('categories.edit');
        Route::get('/{category}',App\Livewire\Category\Show::class)->name('categories.show');
    });

});
