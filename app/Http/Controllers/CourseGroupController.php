<?php

namespace App\Http\Controllers;
use App\Models\CourseGroup;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CourseGroupController extends Controller
{   

    public function index()
    {   
        $courseGroup = CourseGroup::all();

        return view('admin.courseGroup.index', compact('courseGroup'));
    }

    public function store(Request $request): RedirectResponse
    {   
        $input = $request->all();
        CourseGroup::create($input);
        return redirect('admin/courseGroups')->with('success', 'Course Group Addedd!');
    }

    public function edit(CourseGroup $courseGroup)
    {   
        return view('admin.courseGroup.edit', compact('courseGroup'));
    }

    public function update(Request $request, CourseGroup $courseGroup)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'course_group' => 'required',
            'description' => 'required',
        ]);
    
        // Update the user with the validated data
        $courseGroup->update([
            'course_group' => $validatedData['course_group'],
            'description' => $validatedData['description'],

        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.courseGroup.index')->with('success', 'Course Group updated successfully.');
    }
    
    public function destroy(CourseGroup $courseGroup)
    {
        $courseGroup->delete();
        return redirect()->route('admin.courseGroup.index')->with('delete', 'Course Group deleted successfully.');
    }

}
