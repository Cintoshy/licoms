<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    public function index()
    {   
        $course = Course::all();

        return view('admin.Courses.index', compact('course'));
    }

    public function store(Request $request): RedirectResponse
    {   
        $input = $request->all();
        Course::create($input);
        return redirect('admin/courses')->with('flash_message', 'Course Addedd!');
    }

    public function edit(Course $course)
    {
        return view('admin.Courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'course_code' => 'required',
            'course_title' => 'required',
            'course_level' => 'required',
        ]);
    
        // Update the user with the validated data
        $course->update([
            'course_code' => $validatedData['course_code'],
            'course_title' => $validatedData['course_title'],
            'course_level' => $validatedData['course_level'],

        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.course.index')->with('success', 'Course updated successfully.');
    }
    
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.course.index')->with('success', 'Course deleted successfully.');
    }
}
