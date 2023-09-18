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
    public function index(Request $request): JsonResponse
    {
        $sortBy = $request->query('sort_by', 'title');
        $sortOrder = $request->query('sort_order', 'asc');
        $searchQuery = $request->query('search_query', '');

        $validSortColumns = ['title', 'description', 'date', 'priority'];
        if (!in_array($sortBy, $validSortColumns) || !in_array($sortOrder, ['asc', 'desc'])) {
            return response()->json(['error' => 'Invalid sort parameters'], 400);
        }

        $query = Todo::query();

        if ($sortBy === 'priority') {
            $priorityMap = ['low' => 1, 'medium' => 2, 'high' => 3];

            if ($sortOrder !== 'asc') {
                $priorityMap = array_reverse($priorityMap);
            }
            $priorityOrder = implode("', '", array_keys($priorityMap));
            $query->orderByRaw("FIELD(priority, '$priorityOrder')");
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        if (!empty($searchQuery)) {
            $query->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('title', 'like', "%$searchQuery%")
                    ->orWhere('description', 'like', "%$searchQuery%");
            });
        }

        $todos = $query->get();

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

    public function updateIsChecked (Todo $todo): JsonResponse
    {
        $todo->update([
            'is_checked' => !$todo->is_checked
        ]);

        return response()->json($todo, 200);
    }

    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();

        return response()->json(['message' => 'Todo deleted successfully'], 200);
    }

}
