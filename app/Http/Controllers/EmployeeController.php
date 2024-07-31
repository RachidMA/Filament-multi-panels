<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Headquater;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class EmployeeController extends Controller
{
    public function create()
    {
        // dd('THIS IS FROM CONTROLLER');
        // Your custom logic for creating an employee
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $validatedData = $request->validate([
            //'_token' => 'required|string', // CSRF token
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure the email is unique in the 'users' table
            'password' => 'required|min:8|confirmed', // Password must be confirmed
            'userable_type' => 'required|in:headquater,company', // Only allow specific values
            'userable_id' => 'required|integer', // Ensure the ID exists in the userables table
        ]);
        //dd($validatedData['userable_type']);
        // Create the user using the validated data
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Hash the password
            'userable_type' => $validatedData['userable_type'] == 'headquater' ? \App\Models\Headquater::class : \App\Models\Company::class,
            'userable_id' => $validatedData['userable_id'],
        ]);
        //dd('this is new create user ', $user);
        // Redirect to a success page
        return redirect()->route('filament.headquater.resources.users.index')->with('success', 'User created successfully!');
    }

    public function getUserableOptions(Request $request)
    {
        $type = $request->query('type');
        $options = [];

        //dd('THIS IS FROM USEABLE', $request);

        switch ($type) {
            case 'headquater':
                $options = Headquater::pluck('name', 'id');
                break;
            case 'company':
                $options = Company::pluck('name', 'id');
                break;
        }

        return response()->json($options->map(function ($name, $id) {
            return ['id' => $id, 'name' => $name];
        }));
    }
}
