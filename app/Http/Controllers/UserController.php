<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Program;

class UserController extends Controller
{
    public function index()
    {   $allPrograms = Program::all();
        $users = User::all();
        return view('admin.user-type.index', compact('users', 'allPrograms'));
    }
    /*
    public function create()
    {
        $allPrograms = Program::all();
        return view('admin.user-type.create', compact('allPrograms'));
    }
    */

    public function store(Request $request): RedirectResponse
    {   

        $input = $request->all();
        User::create($input);
        return redirect('admin/users')->with('flash_message', 'User Addedd!');
    }


    public function edit(User $user)
    {
        $allPrograms = Program::all(); // Retrieve all programs from the database
    
        return view('admin.user-type.edit', compact('user', 'allPrograms'));
    }
    

    public function update(Request $request, User $user)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'assigned_program' => 'required',
        ]);
    
        // Update the user with the validated data
        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'contact' => $validatedData['contact'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'assigned_program' => $validatedData['assigned_program'],
        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect to the index page with a success message
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
