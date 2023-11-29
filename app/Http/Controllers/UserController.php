<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Program;
use App\Models\Department;

class UserController extends Controller
{
    public function index()
    {   $allPrograms = Program::all();
        $departments = Department::all();
        $employees = User::all();
        return view('admin.user-type.index', compact('employees', 'allPrograms', 'departments'));
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
        $email = $request->input('email') . '@cspc.edu.ph';

        // Check if a user with the same email already exists
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            // Handle the case where the email already exists
            // You can return an error message or redirect back with a message
            return redirect()->back()->with('error', 'Email address is already assigned.');
        }

        $input = $request->all();
        $input['email'] = $email;
        User::create($input);

        return redirect('admin/users')->with('checked', 'User Added');
    }


    public function edit(User $employee) // Accept the ID directly
    {

        $allPrograms = Program::all(); // Retrieve all programs from the database
        
        return view('admin.user-type.edit', compact('employee', 'allPrograms'));
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
            'assigned_program' => 'nullable',
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
        return redirect()->route('admin.users.index')->with('delete', 'User deleted successfully.');
    }
}
