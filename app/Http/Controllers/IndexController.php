<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;    
use App\Models\Book;
use App\Models\RequestedBooks;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {

        $currentDate = Carbon::now();

        $fiveYearsBelow = range(1990, $currentDate->copy()->addYears(1)->year);
        
        $books = Book::all();
        $currentYear = date('Y');
        $bookYears = Book::distinct('year')->pluck('year')->toArray();
        $bookData = $books->pluck('year')->toArray();
        
        $approvedBooks = RequestedBooks::where('status', 'Approved');
        $pendingBooks = RequestedBooks::whereIn('status', ['Verified', 'Selected']);

        return view('admin.index', compact('books', 'approvedBooks', 'pendingBooks', 'currentYear', 'bookYears', 'bookData', 'fiveYearsBelow' ));
    }
}
