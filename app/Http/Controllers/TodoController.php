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
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'priority' => 'required|string',
            'is_checked' => 'boolean',
            'date' => 'date|nullable',
            'user_id' => 'required|string',
        ]);

        // Create a new Todo instance and assign attributes
        $newTodo = new Todo;
        $newTodo->title = $validatedData['title'];
        $newTodo->description = $validatedData['description'];
        $newTodo->priority = $validatedData['priority'];
        $newTodo->is_checked = $validatedData['is_checked'] ?? false;
        $newTodo->date = $validatedData['date'];
        $newTodo->user_id = $validatedData['user_id'];

        // Save the new Todo to the database
        $newTodo->save();

        return response()->json($newTodo, 201);
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
