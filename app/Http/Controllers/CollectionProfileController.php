<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionProfileController extends Controller
{
    public function index()
    {
        return view('admin.CollectionProfile.collection');
    }
    public function listDepartments()
    {   
        // $course = Course::where('assigned_program', 'BSIT')->get();
        // $course = Course::all();
        // $programs = Program::all();
        // $courseGroups = CourseGroup::all();

        return view('admin.CollectionProfile.listDepartments');
    }
}
