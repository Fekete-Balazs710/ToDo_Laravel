<?php

namespace App\Http\Controllers;

use Spatie\QueryBuilder\QueryBuilder;
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
<<<<<<< feature/ITL-9
        $todos = QueryBuilder::for(Todo::class)
=======
        $user = $request->user();
        $searchQuery = $request->input('filter');

        $todos = QueryBuilder::for(Todo::class)
            ->where('user_id', $user->id)
>>>>>>> ITL-10 Implement Laravel API Token Authentication
            ->defaultSort('date')
            ->allowedSorts([
                'title',
                'description',
                'priority',
                'date',
            ])
            ->allowedFilters([
                'title',
                'description',
            ])
<<<<<<< feature/ITL-9
=======
            ->where(function ($query) use ($searchQuery) {
                if ($searchQuery) {
                    $query->where('title', 'like', '%' . $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
                }
            })
>>>>>>> ITL-10 Implement Laravel API Token Authentication
            ->get();

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
