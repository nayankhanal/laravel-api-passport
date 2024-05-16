<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [UserController::class, 'register'])->name('users.register');
Route::post('login', [UserController::class, 'login'])->name('users.login');

Route::group(['middleware'=>'auth:api'], function ($router) {
    $router->get('/',[TodoController::class, 'index'])->name('todos.index');
    $router->post('/create',[TodoController::class, 'store'])->name('todos.store');
});

