<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AddProgramController extends Controller
{
    public function index(Program $program)
    {   
        $courses = Course::all();
        $program = Program::all();

        return view('admin.AssignProgram.addProgram', compact('program', 'courses'));
    }

    public function departmentStore(Request $request): RedirectResponse
    {   

        $input = $request->all();
        Program::create($input);
        return redirect('admin/programs')->with('flash_message', 'Department Addedd!');
    }

    public function courseStore(Request $request): RedirectResponse
    {   

        $input = $request->all();
        Program::create($input);
        return redirect('admin/programs')->with('flash_message', 'Course Addedd!');
    }


    public function edit(Program $program)
    {
        $program = Program::all();
    
        return view('admin.AssignProgram.edit', compact('program'));
    }
    

    public function update(Request $request, Program $program)
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
        return redirect()->route('admin.AssignProgram.addDepartment')->with('success', 'Department updated successfully.');
    }
    

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.AssignProgram.addDepartment')->with('success', 'User deleted successfully.');
    }
}