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
       //  $input['status'] = 'Available'; //
        Book::create($input);
        return redirect('admin/listBooks')->with('success', 'Book Added!');
    }

    public function edit(Book $book)
    {   

        return view('admin.books.edit', compact('book'));
    }
    public function libEdit(Book $book)
    {   

        return view('librarian.edit', compact('book'));
    }
    public function show(Book $book)
    {   
        $courses = Course::all();
        return view('others.allUsers.show', compact('book', 'courses'));
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

    public function libUpdate(Request $request, Book $book)
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
        return redirect()->route('librarian.dashboard')->with('success', 'Book updated successfully.');
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
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        $requestedBooks = RequestedBooks::whereHas('faculty', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->whereIn('status', ['Selected', 'Granted'])->get();
    
        return view('programChair.index', compact('requestedBooks'));
    }

    public function facultyIndex()
    {
        $user = Auth::user();
        $programId = $user->assigned_program;

        $requestedBooks = RequestedBooks::whereHas('faculty', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();

        $books = Book::all();
        $courses = Course::all();
        return view('faculty.index', compact('books', 'requestedBooks', 'courses'));
    }

    public function allBooks()
    {
        $books = Book::all();
        return view('faculty.index', compact('books'));
    }
    
    public function pendingBooks()
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        $requestedBooks = RequestedBooks::whereHas('faculty', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->whereIn('status', ['Selected', 'Granted'])->get();

        $courses = Course::all();
        return view('others.allUsers.pending', compact('requestedBooks', 'courses'));
    }
    
    public function librarianIndex()
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        $requestedBooks = RequestedBooks::whereHas('faculty', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->where('status', 'Selected')->get();

        $book = Book::all();

        return view('librarian.index', compact('requestedBooks', 'book'));
    }
    public function approvedBooks()
    {
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        $requestedBooks = RequestedBooks::whereHas('faculty', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->where('status', 'Approved')->get();
    
        $courses = Course::all();
        return view('others.allUsers.approvedBooks', compact('requestedBooks', 'user', 'courses'));
    }
    public function rejectedBooks()
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        $requestedBooks = RequestedBooks::whereHas('faculty', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->whereIn('status', ['Rejected', 'Denied'])->get();

        return view('others.allUsers.approvedBooks', compact('requestedBooks'));
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
    
    public function selectBook(Request $request, $id)
    {
        $courseCode = $request->input('course_code');
        $s = 1;
    
        // Create a new entry in the RequestedBooks table
        $requestedBook = new RequestedBooks();
        $requestedBook->book_id = $id;
        $requestedBook->course_id = $courseCode; // Assuming your RequestedBooks model has a 'course_id' field to store the course code.
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


}