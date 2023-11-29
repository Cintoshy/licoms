<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;

class DepartmentController extends Controller
{
    public function index(Department $department)
    {   
        $courses = Course::all();
        $department = Department::all();
        $currentDate = Carbon::now();
        
        return view('admin.Departments.index', compact('department', 'courses'));
    }

    public function store(Request $request): RedirectResponse
    {   

        $input = $request->all();
        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('logos', 'public');
            $input['logo'] = $imagePath;
        }
        Department::create($input);
        return redirect('admin/departments')->with('checked', 'Department Added');
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
    
        if ($request->hasFile('logo')) {
            // Handle logo upload
            $imagePath = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $imagePath;
        }
    
        // Update the department with the validated data
        $department->update($validatedData);
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.department.index')->with('success', 'Department updated successfully.');
    }
    
    
    


    public function destroy(Department $department)
    {
        try {
            
            $department->delete();
    
            return redirect()->route('admin.department.index')
                ->with('success', 'Department deleted successfully.');

        } catch (QueryException $e) {
            // Handle the foreign key constraint violation error
            return redirect()->route('admin.department.index')
                ->with('error', 'Cannot delete department due to associated records.');
        }
    }
}