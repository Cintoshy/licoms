<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Program $program)
    {   
        $courses = Course::all();
        $program = Program::all();

        return view('admin.Departments.index', compact('program', 'courses'));
    }

    public function departmentStoreIndex(Request $request): RedirectResponse
    {   

        $input = $request->all();
        Program::create($input);
        return redirect('admin/departments')->with('flash_message', 'Department Addedd!');
    }

    public function edit(Program $program)
    {
        return view('admin.Departments.edit', compact('program'));
    }
    

    public function update(Request $request, Program $program)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'code' => 'required',
            'department' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
    
        // Update the user with the validated data
        $program->update([
            'code' => $validatedData['code'],
            'department' => $validatedData['department'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
    }
    

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.departments.index')->with('success', 'User deleted successfully.');
    }
}