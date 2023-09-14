<?php

namespace App\Http\Controllers;

use App\Http\Requests\{TodoStorePostRequest, TodoUpdateRequest};
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        // Retrieve all Todos and display them
        $todos = Todo::all();
        return response()->json(['todos' => $todos]);
    }

    public function store(TodoStorePostRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $todo = Todo::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'priority' => $validatedData['priority'],
            'is_checked' => $validatedData['is_checked'] ?? false,
            'date' => $validatedData['date'],
            'user_id' => $validatedData['user_id'],
        ]);

        return response()->json($todo, 201);
    }

    public function show(Todo $todo)
    {
        // Show a single Todo
    }

    public function update(TodoUpdateRequest $request, Todo $todo): JsonResponse
    {
        $validatedData = $request->validated();

        $todo->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'priority' => $validatedData['priority'],
            'is_checked' => $validatedData['is_checked']
        ]);

        return response()->json($todo, 200);
    }

    public function destroy(Todo $todo)
    {
        // Delete a Todo from the database
    }

}
