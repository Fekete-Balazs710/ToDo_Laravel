<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        // Retrieve all Todos and display them
        $todos = Todo::all();
        return response()->json(['todos' => $todos]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $user_id = $request->query('user_id');

            //Create the Todo with the default values
            $newTodo = new Todo;
            $newTodo->title = 'Todo Title';
            $newTodo->description = 'Todo Description';
            $newTodo->priority = 'High';
            $newTodo->is_Checked = false;
            $newTodo->date = now();
            $newTodo->user_id = $user_id;

            $newTodo->save();

            return response()->json(['message' => 'Todo created successfully', 'todo' => $newTodo]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating new todo'], 500);
        }
    }

    public function show(Todo $todo)
    {
        // Show a single Todo
    }

    public function update(Request $request, Todo $todo)
    {
        // Update a Todo in the database
    }

    public function destroy(Todo $todo)
    {
        // Delete a Todo from the database
    }

}
