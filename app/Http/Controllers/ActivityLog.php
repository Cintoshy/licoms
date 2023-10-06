<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\RequestedBooks;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Controller
{
    public function index()
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
        $facultyId = $user->id; // Assuming the user's ID corresponds to the faculty ID.
    
        $requestedBooks = RequestedBooks::whereHas('faculty', function ($query) use ($programId, $facultyId) {
            $query->where('assigned_program', $programId)
                  ->where('id', $facultyId); // Match faculty ID as well
        })->whereIn('status', ['Selected'])->get();
    
        $courses = Course::whereHas('program', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();
    
        return view('activityLog', compact('requestedBooks', 'courses'));
    }
    public function pgActivityLog()
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
        $facultyId = $user->id; // Assuming the user's ID corresponds to the faculty ID.
    
        $requestedBooks = RequestedBooks::where('pg_id', $facultyId)
            ->whereIn('status', ['Verified'])
            ->get();
    
        $courses = Course::whereHas('program', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();
    
        return view('activityLog', compact('requestedBooks', 'courses'));
    }
    
}
