<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomUserController extends Controller
{
    public function create()
    {
        // Logic for displaying a custom form or handling user creation
        return view('custom.create-user'); // A custom view for creating users
    }

    public function store(Request $request)
    {
        // Handle the form submission and user creation
        // Validate and create user logic here
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Assuming you have a User model to create the user
        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Redirect or return response
        return redirect()->route('custom.user.index')->with('success', 'User created successfully!');
    }
}
