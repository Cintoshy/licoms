<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\RequestedBooks;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $approvedBooks = RequestedBooks::where('status', 'Approved');
        $pendingBooks = RequestedBooks::whereIn('status', ['Verified', 'Selected']);

        return view('admin.index', compact('books', 'approvedBooks', 'pendingBooks'));
    }
}
