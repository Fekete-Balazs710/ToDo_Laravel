<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Get all todo routes
Route::get('todos', [TodoController::class, 'index']);

// Create new todo
Route::post('todos/new/{userId}', [TodoController::class, 'create']);

// Get todo by id
Route::get('todos/get/{id}', [TodoController::class, 'show']);

// Delete a todo by id
Route::delete('todos/delete/{id}', [TodoController::class, 'destroy']);

// Update isChecked property of todo by id
Route::put('todos/update/isChecked/{id}', [TodoController::class, 'update']);

// Update title, description, and priority
Route::put('todos/update/{id}', [TodoController::class, 'update']);

// Search functionality for todos
Route::post('todos/search/{userId}', [TodoController::class, 'search']);

// Sorting functionality for todos
Route::post('todos/sort/{userId}', [TodoController::class, 'sort']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
