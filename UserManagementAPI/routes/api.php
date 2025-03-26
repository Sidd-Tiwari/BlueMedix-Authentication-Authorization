<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

Route::prefix('users')->group(function () {
    Route::post('/', function (Request $request) { // Create
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:isSeller,isCustomer,isAdmin'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return response()->json($user, 201);
    });

    Route::get('/{id}', function ($id) { // Read
        $user = User::find($id);
        return $user ? response()->json($user) : response()->json(['message' => 'User not found'], 404);
    });

    Route::put('/{id}', function (Request $request, $id) { // Update
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|string|min:6',
            'role' => 'sometimes|in:isSeller,isCustomer,isAdmin'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->update($request->only(['name', 'email', 'role']) + ['password' => $request->password ? Hash::make($request->password) : $user->password]);

        return response()->json($user);
    });

    Route::delete('/{id}', function ($id) { // Delete
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    });
});
