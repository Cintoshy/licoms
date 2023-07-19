<?php

namespace App\Http\Controllers;
use App\Models\Program;

use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        return view('admin.Program.addProgram');
    }


public function edit($id)
{
    $user = User::find($id); // Retrieve the user data from your database

    $programs = Program::all(); // Retrieve all programs from the database

    return view('admin.user-type.edit', compact('user', 'programs'));
}
}