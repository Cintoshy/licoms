<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CourseController extends Controller
{   
    public function listDepartmentsIndex()
    {   
        return view('admin.Courses.list-departments');
    }

    public function index(Request $request)
    {   
        $query = Course::query();
    
        if ($request->has('courseGroup_filter')) {
            $courseGroupFilter = $request->courseGroup_filter;
    
            if (!empty($courseGroupFilter)) {
                $query->where('course_group', $courseGroupFilter);
            }
        }
    
        if ($request->has('program_filter')) {
            $programFilter = $request->program_filter;
    
            if (!empty($programFilter)) {
                $query->where('assigned_program', $programFilter);
            }
        }
        $dateFilterResults = $query->get();

        $course = Course::all();
        $programs = Program::all();
        $courseGroups = CourseGroup::all();

        return view('admin.Courses.index', compact('course', 'programs', 'courseGroups', 'dateFilterResults'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        $courseCode = $input['course_code'];
    
        // Check if a course with the same code already exists
        $existingCourse = Course::where('course_code', $courseCode)->first();
    
        if ($existingCourse) {
            return redirect('admin/courses')->with('error', 'Course with code ' . $courseCode . ' already exists');
        }

        // If no duplicate found, create a new course
        Course::create($input);
    
        return redirect('admin/courses')->with('checked', 'Course added successfully');
    }

    public function edit(Course $course)
    {   
        $programs = Program::all();
        $courseGroups = CourseGroup::all();
        return view('admin.Courses.edit', compact('course', 'programs', 'courseGroups'));
    }

    public function update(Request $request, Course $course)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'course_code' => 'required',
            'course_title' => 'required',
            'course_group' => 'required',
            'course_level' => 'required',
            'assigned_program' => 'required',
        ]);
    
        // Update the user with the validated data
        $course->update([
            'course_code' => $validatedData['course_code'],
            'course_title' => $validatedData['course_title'],
            'course_group' => $validatedData['course_group'],
            'course_level' => $validatedData['course_level'],
            'assigned_program' => $validatedData['assigned_program'],

        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.course.index')->with('checked', 'Course updated successfully.');
    }
    
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.course.index')->with('delete', 'Course deleted successfully.');
    }

    public function CCS()
    {   
        // $course = Course::where('assigned_program', 'BSIT')->get();
        $course = Course::all();
        $programs = Program::all();
        $courseGroups = CourseGroup::all();

        return view('admin.Courses.index', compact('course', 'programs', 'courseGroups'));
    }

}
