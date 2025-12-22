<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Todo Routes
Route::resource('todos', TodoController::class);
Route::post('/todos/{todo}/toggle', [TodoController::class, 'toggleComplete'])->name('todos.toggle');

// API Routes untuk Web Service
Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('/todos', [TodoController::class, 'index']);
    Route::post('/todos', [TodoController::class, 'store']);
    Route::put('/todos/{todo}', [TodoController::class, 'update']);
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy']);
});