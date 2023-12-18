<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Program;
use App\Models\Department;

class CollectionProfileController extends Controller
{
    public function index()
    {   
        $user = Auth::user();
        $assignedDepartment = $user->assigned_department;

        $programs = Program::where('department', $assignedDepartment)->get();   
        return view('librarian.listProgramsReport', compact('programs'));
    }
    public function librarianApprovedBook()
    {   
        $user = Auth::user();
        $assignedDepartment = $user->assigned_department;

        $programs = Program::where('department', $assignedDepartment)->get();   
        return view('librarian.listProgramsApproved', compact('programs'));
    }
    public function librarianPendingBook()
    {   
        $user = Auth::user();
        $assignedDepartment = $user->assigned_department;

        $programs = Program::where('department', $assignedDepartment)->get();   
        return view('librarian.listProgramsPending', compact('programs'));
    }
    public function listDepartments()
    {   
        // $course = Course::where('assigned_program', 'BSIT')->get();
        // $course = Course::all();
        // $programs = Program::all();
        // $courseGroups = CourseGroup::all();
        $departments = Department::all();

        return view('admin.CollectionProfile.listDepartments', compact('departments'));
    }
}
