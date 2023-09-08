<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'role' => ['required', 'in:0,1'],
            'level' => ['required', 'in:0,1,2,3'],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'description' => ['nullable', 'string'],
        ]);
    
        $user = User::create([
            'role' => $request->role,
            'level' => $request->level,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
            'description' => $request->description,
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return response()->noContent();
    }

    public function fetchUserByUsername($username)
    {
        try {
            $department = User::where('username', $username)->firstOrFail();
            return response()->json($department);
        } catch (ModelNotFoundException $exception) {
            // \Log::error('User not found by username: ' . $exception->getMessage());
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    public function update($userId, Request $request)
    {
        $user = User::find($userId);

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'. $user->userId],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'. $user->userId],
            'description' => ['nullable', 'string'],
        ]);

        // Update the user attributes
        $user->update($validatedData);
        // $user->name = $request->name;
        // $user->username = $request->username;
        // $user->email = $request->email;
        // $user->description = $request->description;

        // $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }
    
}
