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
        $books = Book::all();

            // Assuming $books is a collection of book data
            $bookData = $books->pluck('year')->toArray();
            
            // Create a range of years
            $years = range(1985, $currentDate->copy()->addYears(1)->year);

            // Count the occurrences of each unique year in $bookData
            $yearBookCounts = array_count_values($bookData);

            // Ensure that all years within the range have counts, setting non-present years to zero
            foreach ($years as $year) {
                if (!isset($yearBookCounts[$year])) {
                    $yearBookCounts[$year] = 0;
                }
            }

            ksort($yearBookCounts);

            $yearBookCounts = array_values($yearBookCounts);
            


        $currentYear = date('Y');
        $bookYears = Book::distinct('year')->pluck('year')->toArray();

        $approvedBooks = RequestedBooks::where('status', 'Approved');
        $pendingBooks = RequestedBooks::whereIn('status', ['Verified', 'Selected']);

        return view('admin.index', compact('books', 'approvedBooks', 'pendingBooks', 'currentYear', 'bookYears', 'bookData', 'years', 'yearBookCounts' ));
    }
}
