<?php

use Illuminate\Support\Facades\Route;

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

    Route::prefix('/user')->group(function(){
        Route::get('/',App\Livewire\User\Index::class)->name('users.index');
        Route::get('/create',App\Livewire\User\Create::class)->name('users.create');
        Route::get('/edit/{user}',App\Livewire\User\Edit::class)->name('users.edit');
        Route::get('/{user}',App\Livewire\User\Show::class)->name('users.show');
    });
});
