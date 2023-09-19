<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserStorePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response([
                'message' => 'Unauthorized'
            ], 401);
        }

        $userFirstName = $user->first_name;
        $userLastName = $user->last_name;

        $response = [
            'firstName' => $userFirstName,
            'lastName' => $userLastName
        ];

        return response($response, 200);
    }

    public function store(UserStorePostRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ]);

        return response()->json($user, 201);
    }
}
