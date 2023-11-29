<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Program $program)
    {   
        $departments = Department::all();
        $courses = Course::all();
        $program = Program::all();

        return view('admin.Programs.index', compact('program', 'courses', 'departments'));
    }

    public function store(Request $request): RedirectResponse
    {   

        $input = $request->all();
        Program::create($input);
        return redirect('admin/programs')->with('checked', 'Program Added');
    }

    public function edit(Program $program)
    {
        $departments = Department::all();
        return view('admin.Programs.edit', compact('program', 'departments'));
    }
    

    public function update(Request $request, Program $program)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'department' => 'required',
            'minimum_req' => 'required',
        ]);
    
        // Update the user with the validated data
        $program->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'department' => $validatedData['department'],
            'minimum_req' => $validatedData['minimum_req'],
        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.program.index')->with('success', 'Program updated successfully.');
    }
    

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.program.index')->with('delete', 'Program deleted successfully.');
    }
}