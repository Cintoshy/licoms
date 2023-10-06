<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Department $department)
    {   
        $courses = Course::all();
        $department = Department::all();

        return view('admin.Departments.index', compact('department', 'courses'));
    }

    public function store(Request $request): RedirectResponse
    {   

        $input = $request->all();
        Department::create($input);
        return redirect('admin/departments')->with('success', 'Department Addedd!');
    }

    public function edit(Department $department)
    {
        return view('admin.Departments.edit', compact('department'));
    }
    

    public function update(Request $request, Department $department)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'department_name' => 'required',
            'description' => 'required',
        ]);
    
        // Update the user with the validated data
        $department->update([
            'department_name' => $validatedData['department_name'],
            'description' => $validatedData['description'],
        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.department.index')->with('success', 'Department updated successfully.');
    }
    

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.department.index')->with('delete', 'Department deleted successfully.');
    }
}