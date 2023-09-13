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

    public function create()
    {
        // Show the form to create a new Todo
    }

    public function show(Todo $todo)
    {
        // Show a single Todo
    }

    public function update(Request $request, Todo $todo)
    {
        // Update a Todo in the database
    }

    public function search(Request $request)
    {
        //Searching functionality
    }

    public function sort(Request $request)
    {
        //Sorting functionality
    }
    public function destroy(Todo $todo)
    {
        // Delete a Todo from the database
    }

}
