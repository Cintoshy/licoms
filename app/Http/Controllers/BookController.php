<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Course;
use App\Models\RequestedBooks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function userSidebar()
    {   
        $user = User::all();
        return view('layout.header', compact('user'));
    }
    public function adminIndex()
    {   
        $books = Book::all();
        return view('admin.Books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.Books.addBook');
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        $input['status'] = 'Available'; // Set the status to 'Available'
        Book::create($input);
        return redirect('admin/listBooks')->with('success', 'Book Added!');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function show(Book $book)
    {   
        return view('admin.books.show', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'access_no' => 'required',
            'copy' => 'required',
            'year' => 'required',
            'publish' => 'required',
        ]);

        // Update the book with the validated data
        $book->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('admin-books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        // Delete the book
        $book->delete();

        // Redirect to the index page with a success message
        return redirect()->route('admin-books.index')->with('delete', 'Book deleted successfully.');
    }

    public function allStatus()
    {
        $requestedBooks = RequestedBooks::all();
        return view('admin.Books.allStatus', compact('requestedBooks'));
    }

    public function pgIndex()
    {
        $requestedBooks = RequestedBooks::whereIn('status', ['Selected', 'granted'])->get();
        return view('programChair.index', compact('requestedBooks'));
    }

    public function facultyIndex()
    {
        $books = Book::all();
        $courses = Course::all();
        return view('faculty.index', compact('books', 'courses'));
    }
    public function allBooks()
    {
        $books = Book::all();
        return view('faculty.index', compact('books'));
    }
    
    public function pendingBooks()
    {
        $requestedBooks = RequestedBooks::whereIn('status', ['Selected', 'granted'])->get();
        return view('others.allUsers.pending', compact('requestedBooks'));
    }
    public function librarianIndex()
    {
        $requestedBooks = RequestedBooks::where('status', 'Selected')->get();
        return view('librarian.index', compact('requestedBooks'));
    }
    public function approvedBooks()
    {
        $requestedBooks = RequestedBooks::where('status', 'Approved')->get();
        return view('others.allUsers.approvedBooks', compact('requestedBooks'));
    }
    public function pendingBooks1()
    {
        $books = Book::whereIn('status', ['Selected', 'Granted'])->get();
        return view('others.allUsers.approvedBooks', compact('books'));
    }
    public function rejectedBooks()
    {
        $books = Book::whereIn('status', ['Rejected', 'Denied'])->get();
        return view('others.allUsers.approvedBooks', compact('books'));
    }


    public function cancelBook($id)
    {
        $status = RequestedBooks::find($id);

        $status->status='Available';

        $status->save();
    
        return redirect()->back();
    }

    public function denyBook($id)
    {
        $status = RequestedBooks::find($id);

        $status->status='Denied';

        $status->save();

        return redirect()->back();

    }

    public function rejectBook($id)
    {
        $requestedBooks = RequestedBooks::find($id);

        $requestedBooks->status='Rejected';

        $requestedBooks->save();

        return redirect()->back();

    }
    public function changeStatus($id)
    {
        // Retrieve the book by ID
        $book = Book::findOrFail($id);

        // Update the book status or perform any other necessary actions

        return redirect()->back();
    }

    public function cancelGrant($id)
    {
        $bookTracking = RequestedBooks::where('book_id', $id)->first();

        $bookTracking->lib_id = null;

        $bookTracking->status ='Selected';

        $bookTracking->save();

        return redirect()->back();
    }
    

    public function selectBook($id)
    {

        // Create a new entry in the BookTracking table
        $requestedBook = new RequestedBooks();
        $requestedBook->book_id = $id;
        $requestedBook->fac_id = Auth::id();
        $requestedBook->status = 'Selected';
        $requestedBook->save();

        return redirect()->back()->with('success', 'Book has been selected successfully.');
    }

    public function grantBook($id)
    {
        // Find the book tracking entry
        $bookTracking = RequestedBooks::where('book_id', $id)->first();
    
        // Update the book tracking status and librarian ID
        $bookTracking->lib_id = auth()->id();
        $bookTracking->status = 'Granted';
        $bookTracking->save();
    
        // Return a response or redirect as needed
        return redirect()->back()->with('success', 'Book granted successfully');
    }
    

        public function approveBook($id)
        {
            // Find the book tracking entry
            $bookTracking = RequestedBooks::where('id', $id)->first();

            // Update the book tracking status and librarian ID
            $bookTracking->pg_id = Auth::id();
            $bookTracking->status = 'Approved';
            $bookTracking->save();

            // Return a response or redirect as needed
            return redirect()->back()->with('success', 'Book approved successfully');
     }

    /* public function index()
{
    $user = Auth::user();
    $programId = $user->assigned_program;

    // Retrieve book requests only for the user's assigned program
    $bookRequests = RequestedBooks::where(function ($query) use ($programId) {
        $query->where('pg_id', $programId); // Program Chair requests // Faculty member requests for their own program
    })->get();

    return view('admin.Books.index1', compact('bookRequests'));
}*/
public function index()
{
    $user = Auth::user();
    $programId = $user->assigned_program;

    // Retrieve book requests where the faculty requester's assigned_program matches the user's assigned program
    $bookRequests = RequestedBooks::whereHas('faculty', function ($query) use ($programId) {
        $query->where('assigned_program', $programId);
    })->get();

    return view('admin.Books.index1', compact('user', 'bookRequests'));
}








}