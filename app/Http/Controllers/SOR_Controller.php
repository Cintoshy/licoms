<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RequestedBooks;


class SOR_Controller extends Controller
{
    public function index()
    {
        return view('admin.SOR.index');
    }
    public function summaryRecords()
    {   
        $books = RequestedBooks::join('books', 'requested_books.book_id', '=', 'books.id')
        ->where('status', 'Approved')
        ->selectRaw('requested_books.course_id, requested_books.program_name, SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles')
        ->groupBy('requested_books.course_id', 'requested_books.program_name')
        ->orderBy('requested_books.course_id', 'asc')
        ->with('course', 'program')
        ->get();

        $groupedBooks = $books->groupBy('program.name');

        return view('admin.SOR.summaryRecords', compact('groupedBooks'));
    }
    public function wewe()
    {
        return view('handleSession');
    }

    public function cancelLogoutSession()
    {
        if (Auth::check()) {
            // User is logged in, redirect based on role
            $user = Auth::user();
            if ($user->role == '0') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == '1') {
                return redirect()->route('program-chair.index');
            } elseif ($user->role == '2') {
                return redirect()->route('librarian.dashboard');
            } elseif ($user->role == '3') {
                return redirect()->route('faculty.dashboard');
            }
        }   
        // User is not logged in or role not found, show the landing view
        return view('landing');
    }

}
