<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\User;
use App\Models\RequestedBooks;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Notifications\BookApprovalNotification;
use App\Notifications\BookSelectNotification;
use App\Notifications\BookGrantedNotification;
use App\Notifications\BookRejectedNotification;
use Illuminate\Notifications\DatabaseNotification;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Mail\BookApprovalMail;




class BookController extends Controller
{
    public function adminIndex(Request $request)
    {   
        $years = Book::orderBy('year')
            ->distinct('year')
            ->get();
    

        $query = Book::query();

    
        if ($request->has('year_filter')) {
            $yearFilter = $request->year_filter;
    
            if (!empty($yearFilter)) {
                $query->where('year', $yearFilter);
            }
        }
    
    
        if ($request->has('date_filter')) {
            $dateFilter = $request->date_filter;
            if (!empty($dateFilter)) {
                switch ($dateFilter) {
                    case 'today':
                        $query->whereDate('created_at', Carbon::today());
                        break;
                    case 'yesterday':
                        $query->whereDate('created_at', Carbon::yesterday());
                        break;
                    case 'this_week':
                        $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                        break;
                    case 'last_week':
                        $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
                        break;
                    case 'this_month':
                        $query->whereMonth('created_at', Carbon::now()->month);
                        break;
                    case 'last_month':
                        $query->whereMonth('created_at', Carbon::now()->subMonth()->month);
                        break;
                    case 'this_year':
                        $query->whereYear('created_at', Carbon::now()->year);
                        break;
                    case 'last_year':
                        $query->whereYear('created_at', Carbon::now()->subYear()->year);
                        break;
                    // Add more cases here for additional options
                }
            }
        }
    
        $dateFilterResults = $query->get();

        $programs = Program::all();
        $books = Book::all();
    
        return view('admin.Books.index', compact('books', 'years', 'programs', 'dateFilterResults'));
    }
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        $input['access_no'] = json_encode($input['access_no']);
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
    public function showApprovedBookPage(RequestedBooks $approvedBook)
    
    {   
        $courses = Course::all();
        return view('others.bookTrackingNotif.viewApprovedBook', compact('courses', 'approvedBook'));
    }

    public function update(Request $request, Book $book)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'call_number' => 'required',
            'title' => 'required',
            'author' => 'required',
            'volume' => 'required',
            'year' => 'required',
            'publish' => 'required',
        ]);
    
        // Update the book with the validated data (except for access_no)
        $book->fill($validatedData)->save();
    
        // Update the access_no field separately
        $accessNo = $request->input('access_no');
        $accessNum = explode(',', $accessNo);
        $book->access_no = json_encode($accessNum);

        $book->save();
    
        // Redirect to the index page with a success message
        return redirect()->route('admin-books.index')->with('success', 'Book updated successfully.');
    }
    
    
    // public function update(Request $request,  Book $book) {
    //     $accessNo = $request->input('access_no');

    //     $accessNum = explode(',', $accessNo);
    //     $book->access_no = json_encode($accessNum);
    //     $book->save();
    
    //     return redirect()->back()->with('success', 'Access No. updated successfully.');
    // }
    

    public function libUpdate(Request $request, Book $book)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'call_number' => 'required',
            'title' => 'required',
            'author' => 'required',
            'volume' => 'required',
            'year' => 'required',
            'publish' => 'required',
        ]);
    
        // Update the book with the validated data (except for access_no)
        $book->fill($validatedData)->save();
    
        // Update the access_no field separately
        $accessNo = $request->input('access_no');
        $accessNum = explode(',', $accessNo);
        $book->access_no = json_encode($accessNum);

        $book->save();

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
    public function cancelSelectedBook(RequestedBooks $requestedBook)
    {   
        // Get the associated book
        $book = $requestedBook->book;
    
        // Update the availability of the book to true
        $book->update(['availability' => true]);
    
        // Delete the book request
        $requestedBook->delete();
    
        // Redirect to the index page with a success message
        return redirect()->route('activityLogs')->with('delete', 'Book has been canceled successfully.');
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
    
        // Retrieve requested books for the same program as the program chair
        $requestedBooks = RequestedBooks::where('program_name', $programId)
                                        ->where('status', 'Selected')
                                        ->get();
    
        return view('programChair.index', compact('requestedBooks'));
    }

    
    

    public function facultyIndex()
    {
        $user = Auth::user();
        $programId = $user->assigned_program;

        $books = Book::available()
        ->where(function ($query) use ($programId) {
            $query->whereNull('program_hidden')
                ->orWhereJsonDoesntContain('program_hidden', $programId);
        })
        ->where(function ($query) use ($programId) {
            $query->whereNull('program_hide_request')
                ->orWhereJsonDoesntContain('program_hide_request', $programId);
        })
        ->get();    
    
        $courses = Course::whereHas('program', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();

        return view('faculty.index', compact('books', 'courses'));
    }

    public function updateProgramHideRequest($id)
    {   
            $user = Auth::user();
            $programId = $user->assigned_program;
            $book = Book::find($id);
            // Retrieve the current value of program_hide_request
            $currentPrograms = json_decode($book->program_hide_request) ?? [];
        
            // Check if the program is not already present in the programs array
            if (!in_array($programId, $currentPrograms)) {
                $currentPrograms[] = $programId;
        
                // Update the book's program_hide_request attribute
                $book->program_hide_request = json_encode($currentPrograms);
                $book->save();
            }

            return redirect()->back()->with('success', 'Your request to hide the book has been sent to the Program Chair.');
    }
    public function acceptHideRequest($id)
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
        $book = Book::find($id);
        // Retrieve the current value of program_hide_request
        $currentPrograms = json_decode($book->program_hidden) ?? [];
    
        // Check if the program is not already present in the programs array
        if (!in_array($programId, $currentPrograms)) {
            $currentPrograms[] = $programId;
    
            // Update the book's program_hidden attribute
            $book->program_hidden = json_encode($currentPrograms);
            $book->save();
        }
    
            return redirect()->back()->with('success', 'The request has been accepted');

        
    }
    

    public function ProgramHideRequest()
    {   
            $user = Auth::user();
            $programId = $user->assigned_program;
            $books = Book::whereJsonContains('program_hide_request', $programId)
            ->where(function ($query) use ($programId) {
                $query->whereJsonDoesntContain('program_hidden', $programId)
                      ->orWhereNull('program_hidden');
            })
            ->get();
        

            return view('programChair.hideRequest', compact('books'));
    }
    public function archivedBooks()
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        // Retrieve books where 'program_hide_request' contains the programId
        // and 'program_hidden' does not contain the programId
        $books = Book::whereJsonContains('program_hide_request', $programId)
                     ->where(function ($query) use ($programId) {
                         $query->whereJsonDoesntContain('program_hidden', $programId)
                               ->orWhereNull('program_hidden');
                     })
                     ->get();
    
        // Retrieve courses related to the program
        $courses = Course::whereHas('program', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();
    
        return view('faculty.archivedBooks', compact('books', 'courses'));
    }
    
    
    

    
    public function RefuseHideRequest($id)
    {
        // Get the currently authenticated user
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        // Find the book by its ID
        $book = Book::find($id);
    
        // Check if the book exists
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found');
        }
    
        // Decode the JSON string in the 'program_hide_request' column
        $programHideRequest = json_decode($book->program_hide_request, true);
    
        // Check if the program ID exists in the JSON array
        if (is_array($programHideRequest) && in_array($programId, $programHideRequest)) {
            // Remove the program ID from the JSON array
            $programHideRequest = array_diff($programHideRequest, [$programId]);
    
            // Update the 'program_hide_request' column with the modified JSON array
            Book::where('id', $id)->update(['program_hide_request' => json_encode(array_values($programHideRequest))]);
    
            return redirect()->back()->with('success', 'The Book is now visible');
        }
    
        return redirect()->back()->with('error', 'Unable to unhide the book');
    }
    
    

    public function listBooksApproval()
    {
        $user = Auth::user();
        $programId = $user->assigned_program;

        $requestedBooks = RequestedBooks::whereHas('faculty', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();

        $books = Book::available()->get();

        $courses = Course::whereHas('program', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();

        return view('librarian.book_list_approval', compact('books', 'requestedBooks', 'courses'));
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
        })->whereIn('status', ['Selected', 'Verified'])->get();

        $courses = Course::whereHas('program', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();
        return view('others.allUsers.pending', compact('requestedBooks', 'courses'));
    }
    
    public function librarianIndex()
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        $requestedBooks = RequestedBooks::where('program_name', $programId)
                                        ->whereIn('status', ['Selected', 'Verified'])
                                        ->get();
        
        $book = Book::all();
        $programs = Program::all();

        return view('librarian.index', compact('requestedBooks', 'book', 'programs'));
    }

    public function approvedBooks()
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Get the program name of the user
        $programName = $user->assigned_program;
    
        // Query the requested books that belong to the same program name and have a status of 'Approved'
        $requestedBooks = RequestedBooks::where(function ($query) use ($programName) {
            $query->whereHas('program', function ($query) use ($programName) {
                $query->where('name', $programName);
            })->orWhere(function ($query) use ($programName) {
                $query->whereNull('fac_id')
                      ->whereHas('programChair', function ($query) use ($programName) {
                          $query->where('assigned_program', $programName);
                      });
            });
        })->where('status', 'Approved')->get();
    
        // Get all courses (assuming 'Course' is an Eloquent model)
        $courses = Course::whereHas('program', function ($query) use ($programName) {
            $query->where('assigned_program', $programName);
        })->get();
    
        // Return the view 'others.allUsers.approvedBooks' with the data 'requestedBooks', 'user', and 'courses'
        return view('others.allUsers.approvedBooks', compact('requestedBooks', 'user', 'courses'));
    }
    
    public function rejectedBooks()
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        $requestedBooks = RequestedBooks::whereHas('faculty', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->whereIn('status', ['Rejected', 'Denied'])->get();

        return view('others.allUsers.rejectedBooks', compact('requestedBooks'));
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

        $ProgramCode = Auth::user()->assigned_program;
        $libId = Auth::id();

        $requestedBooks = RequestedBooks::with('book')->find($id);
        $requestedBooks->book->update(['availability' => true]);
        $requestedBooks->status='Rejected';
        $requestedBooks->lib_id = $libId;

        $requestedBooks->save();


        $usersWithSameProgram = User::where('assigned_program', $ProgramCode)->get();
        foreach ($usersWithSameProgram as $user) {
            $user->notify(new BookRejectedNotification($requestedBooks));
        }

        return redirect()->back()->with('reject', 'Book request has been rejected successfully');

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

        if (empty($courseCode)) {
            return redirect()->back()->with('error', 'Course code is required.');
        }
        $facId = Auth::id();
    
        // Get the program code for the current faculty
        $facultyProgramCode = Auth::user()->assigned_program;

        $selectedBook = Book::find($id);
    
       // Get the year of the selected book

    
        // Create a new entry in the RequestedBooks table
        $requestedBook = new RequestedBooks();
        $requestedBook->book_id = $id;
        $requestedBook->course_id = $courseCode;
        $requestedBook->fac_id = $facId;
        $requestedBook->status = 'Selected';
        $requestedBook->program_name = $facultyProgramCode;

    
        $requestedBook->save();

        $selectedBook = Book::find($id);
        if ($selectedBook) {
            $selectedBook->availability = false;
            $selectedBook->save();
        }
    
        // Notify users with the same assigned_program
        $usersWithSameProgram = User::where('assigned_program', $facultyProgramCode)->get();
        foreach ($usersWithSameProgram as $user) {
            $user->notify(new BookSelectNotification($requestedBook));
        }
    
        return redirect()->back()->with('success', 'Book has been selected successfully.');
    }    
    
    public function autoApprovedBook(Request $request, $id)
    {
        $courseCode = $request->input('course_code');
        $librarianId = Auth::id();
    
        // Get the program code for the current faculty
        $ProgramCode = Auth::user()->assigned_program;
    
        // Check if a requested book with the same book_id, course_id, and program_code exists for the authenticated faculty.
        $existingRequestedBook = RequestedBooks::where('book_id', $id)
            ->where('course_id', $courseCode)
            ->where('program_name', $ProgramCode)
            ->first();
    
        if ($existingRequestedBook) {
            // If a requested book with the same book_id, course_id, program_id, and fac_id exists, redirect back with an error message.
            return redirect()->back()->with('error', 'The book is already on-going for the selected course code within your program.');
        }
    
        // Create a new entry in the RequestedBooks table
        $requestedBook = new RequestedBooks();
        $requestedBook->book_id = $id;
        $requestedBook->course_id = $courseCode;
        $requestedBook->lib_id = $librarianId;
        $requestedBook->status = 'Approved';
        $requestedBook->program_name = $ProgramCode;
        $requestedBook->approved_at = now();
    
        $requestedBook->save();

        $selectedBook = Book::find($id);
        if ($selectedBook) {
            $selectedBook->availability = false;
            $selectedBook->save();
        }
    
        // Notify users with the same assigned_program
        $usersWithSameProgram = User::where('assigned_program', $ProgramCode)->get();
        foreach ($usersWithSameProgram as $user) {
            $user->notify(new BookApprovalNotification($requestedBook));
        }
    
        return redirect()->back()->with('success', 'Book has been approved successfully.');
    } 

    public function verified($id)
    {   
        $ProgramCode = Auth::user()->assigned_program;
        $pgId = Auth::id();
        // Find the book tracking entry
        $bookTracking = RequestedBooks::where('id', $id)->first();
    
        // Update the book tracking status and Program Chair ID
        $bookTracking->status = 'Verified';
        $bookTracking->pg_id = $pgId;
       
        $bookTracking->verified_at = now();
        $bookTracking->save();

        $usersWithSameProgram = User::where('assigned_program', $ProgramCode)->get();
        foreach ($usersWithSameProgram as $user) {
            $user->notify(new BookGrantedNotification($bookTracking));
        }
    
        // Return a response or redirect as needed
        return redirect()->back()->with('success', 'Book request verified successfully');
    }
    

    public function approveBook($id)
    {
        // Find the book tracking entry with the 'faculty' relationship eager-loaded
        $bookTracking = RequestedBooks::with('faculty')->where('id', $id)->first();
    
        if (!$bookTracking) {
            return redirect()->back()->with('error', 'Book not found');
        }
    
        $bookTracking->lib_id = Auth::id();
        $bookTracking->status = 'Approved';
        $bookTracking->approved_at = now();
        $bookTracking->save();
    
        $usersParticipated = User::whereIn('id', [$bookTracking->fac_id, $bookTracking->pg_id])->get();
        
        // Mail::to('mackieodavar42@gmail.com')->send(new BookApprovalMail($bookTracking));
        foreach ($usersParticipated as $user) {
            
            $user->notify(new BookApprovalNotification($bookTracking));
        }
    
        // Return a response or redirect as needed
        return redirect()->back()->with('checked', 'Book request approved successfully');
    }
    // $usersParticipated = User::where('id',$bookTracking->fac_id)->get();
    // $user = $usersParticipated->first();
    // // Mail::to('mackieodavar42@gmail.com')->send(new BookApprovalMail($bookTracking));

    //     $user->notify(new BookApprovalNotification($bookTracking));
   
    public function reportIndex(){
        $currentDate = Carbon::now();
        $nineYearsAgo = $currentDate->copy()->subYears(9);
        $eightYearsAgo = $currentDate->copy()->subYears(8);
        $sevenYearsAgo = $currentDate->copy()->subYears(7);
        $sixYearsAgo = $currentDate->copy()->subYears(6);
        $fiveYearsAgo = $currentDate->copy()->subYears(5);
        $fourYearsAgo = $currentDate->copy()->subYears(4);
        $threeYearsAgo = $currentDate->copy()->subYears(3);
        $twoYearsAgo = $currentDate->copy()->subYears(2);
        $oneYearsAgo = $currentDate->copy()->subYears(1);
    
        // $books = RequestedBooks::selectRaw('year, course_id, SUM(volume) as total_volumes, COUNT(id) as total_titles')
        //     ->groupBy('year', 'course_id')
        //     ->orderBy('year', 'asc')
        //     ->orderBy('course_id', 'asc')
        //     ->with('course')
        //     ->get();
        
        $ProgramCode = 'BSIT';
        $books = RequestedBooks::where('program_name', 'BSIT')
        ->join('books', 'requested_books.book_id', '=', 'books.id')
        ->selectRaw('books.year, requested_books.course_id, SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles')
        ->groupBy('books.year', 'requested_books.course_id')
        ->orderBy('books.year', 'asc')
        ->orderBy('requested_books.course_id', 'asc')
        ->with('course')
        ->get();
        
        $groupedBooks = $books->groupBy('course_id')->map(function ($courseGroup) {
            return $courseGroup->groupBy('year');
        });
        

        $fiveYearsBelow = [$fiveYearsAgo->year, $sixYearsAgo->year, $sevenYearsAgo->year, $eightYearsAgo->year, $nineYearsAgo->year];

        $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year];

        return view('admin.CollectionProfile.collection', compact('books', 'groupedBooks', 'years', 'fiveYearsAgo', 'fiveYearsBelow', 'ProgramCode'));
    }
    
    
    public function reports(){
        $currentDate = Carbon::now();
        $nineYearsAgo = $currentDate->copy()->subYears(9);
        $eightYearsAgo = $currentDate->copy()->subYears(8);
        $sevenYearsAgo = $currentDate->copy()->subYears(7);
        $sixYearsAgo = $currentDate->copy()->subYears(6);
        $fiveYearsAgo = $currentDate->copy()->subYears(5);
        $fourYearsAgo = $currentDate->copy()->subYears(4);
        $threeYearsAgo = $currentDate->copy()->subYears(3);
        $twoYearsAgo = $currentDate->copy()->subYears(2);
        $oneYearsAgo = $currentDate->copy()->subYears(1);
    
        // $books = RequestedBooks::selectRaw('year, course_id, SUM(volume) as total_volumes, COUNT(id) as total_titles')
        //     ->groupBy('year', 'course_id')
        //     ->orderBy('year', 'asc')
        //     ->orderBy('course_id', 'asc')
        //     ->with('course')
        //     ->get();
        $ProgramCode = Auth::user()->assigned_program;
        $books = RequestedBooks::where('program_name', $ProgramCode)
        ->join('books', 'requested_books.book_id', '=', 'books.id')
        ->selectRaw('books.year, requested_books.course_id, SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles')
        ->groupBy('books.year', 'requested_books.course_id')
        ->orderBy('books.year', 'asc')
        ->orderBy('requested_books.course_id', 'asc')
        ->with('course')
        ->get();
        
        $groupedBooks = $books->groupBy('course_id')->map(function ($courseGroup) {
            return $courseGroup->groupBy('year');
        });
        

        $fiveYearsBelow = [$fiveYearsAgo->year, $sixYearsAgo->year, $sevenYearsAgo->year, $eightYearsAgo->year, $nineYearsAgo->year];

        $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year];

        return view('admin.CollectionProfile.collection', compact('books', 'groupedBooks', 'years', 'fiveYearsAgo', 'fiveYearsBelow', 'ProgramCode'));
    }
        public function exportPdfss()
        {
            $currentDate = Carbon::now();
            $nextYear = $currentDate->addYear();
            $nineYearsAgo = $currentDate->copy()->subYears(9);
            $eightYearsAgo = $currentDate->copy()->subYears(8);
            $sevenYearsAgo = $currentDate->copy()->subYears(7);
            $sixYearsAgo = $currentDate->copy()->subYears(6);
            $fiveYearsAgo = $currentDate->copy()->subYears(5);
            $fourYearsAgo = $currentDate->copy()->subYears(4);
            $threeYearsAgo = $currentDate->copy()->subYears(3);
            $twoYearsAgo = $currentDate->copy()->subYears(2);
            $oneYearsAgo = $currentDate->copy()->subYears(1);

            
        
            // Fetch the data as you did before
            $ProgramCode = Auth::user()->assigned_program;
            $books = RequestedBooks::where('program_name', $ProgramCode)
                ->join('books', 'requested_books.book_id', '=', 'books.id')
                ->selectRaw('books.year, requested_books.course_id, SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles')
                ->groupBy('books.year', 'requested_books.course_id')
                ->orderBy('books.year', 'asc')
                ->orderBy('requested_books.course_id', 'asc')
                ->with('course')
                ->get();
        
            $groupedBooks = $books->groupBy('course_id')->map(function ($courseGroup) {
                return $courseGroup->groupBy('year');
            });
        
            $fiveYearsBelow = [$fiveYearsAgo->year, $sixYearsAgo->year, $sevenYearsAgo->year, $eightYearsAgo->year, $nineYearsAgo->year];
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year];
            
            // Load the PDF view and generate the PDF
            $pdf = PDF::loadView('pdfs', compact('books', 'groupedBooks', 'years', 'fiveYearsAgo', 'fiveYearsBelow', 'ProgramCode'))->setPaper('a3', 'landscape');
            
            // Return the PDF for download
            return $pdf->download('collection_report.pdf');
        }

        public function pdf()
        {
            $currentDate = Carbon::now();
            $nextYear = $currentDate->copy()->addYear();
            $nineYearsAgo = $currentDate->copy()->subYears(9);
            $eightYearsAgo = $currentDate->copy()->subYears(8);
            $sevenYearsAgo = $currentDate->copy()->subYears(7);
            $sixYearsAgo = $currentDate->copy()->subYears(6);
            $fiveYearsAgo = $currentDate->copy()->subYears(5);
            $fourYearsAgo = $currentDate->copy()->subYears(4);
            $threeYearsAgo = $currentDate->copy()->subYears(3);
            $twoYearsAgo = $currentDate->copy()->subYears(2);
            $oneYearsAgo = $currentDate->copy()->subYears(1);
        
            // $books = RequestedBooks::selectRaw('year, course_id, SUM(volume) as total_volumes, COUNT(id) as total_titles')
            //     ->groupBy('year', 'course_id')
            //     ->orderBy('year', 'asc')
            //     ->orderBy('course_id', 'asc')
            //     ->with('course')
            //     ->get();
            $ProgramCode = 'BSIT';
            $books = RequestedBooks::where('program_name', $ProgramCode)
            ->where('status', 'Approved')
            ->join('books', 'requested_books.book_id', '=', 'books.id')
            ->selectRaw('requested_books.course_id, SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles, books.year as book_year')
            ->groupBy('requested_books.course_id', 'books.year')
            ->orderBy('requested_books.course_id', 'asc')
            ->with('course')
            ->get();
            
            $groupedBooks = $books
            ->groupBy('course_id');

            $courseGroupsssBooksTitle = $books
            ->groupBy('course.course_group');

            $fiveYearsBelow = [$fiveYearsAgo->year, $sixYearsAgo->year, $sevenYearsAgo->year, $eightYearsAgo->year, $nineYearsAgo->year];
    
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];
    
            return view('admin.CollectionProfile.collection', compact('books', 'groupedBooks', 'courseGroupsssBooksTitle', 'years', 'fiveYearsAgo', 'nextYear', 'fiveYearsBelow', 'ProgramCode'));
        }
        public function pgPdf()
        {
            $currentDate = Carbon::now();
            $nextYear = $currentDate->copy()->addYear();
            $nineYearsAgo = $currentDate->copy()->subYears(9);
            $eightYearsAgo = $currentDate->copy()->subYears(8);
            $sevenYearsAgo = $currentDate->copy()->subYears(7);
            $sixYearsAgo = $currentDate->copy()->subYears(6);
            $fiveYearsAgo = $currentDate->copy()->subYears(5);
            $fourYearsAgo = $currentDate->copy()->subYears(4);
            $threeYearsAgo = $currentDate->copy()->subYears(3);
            $twoYearsAgo = $currentDate->copy()->subYears(2);
            $oneYearsAgo = $currentDate->copy()->subYears(1);
            
        
            // $books = RequestedBooks::selectRaw('year, course_id, SUM(volume) as total_volumes, COUNT(id) as total_titles')
            //     ->groupBy('year', 'course_id')
            //     ->orderBy('year', 'asc')
            //     ->orderBy('course_id', 'asc')
            //     ->with('course')
            //     ->get();
            $ProgramCode = Auth::user()->assigned_program;
            $books = RequestedBooks::where('program_name', $ProgramCode)
            ->where('status', 'Approved')
            ->join('books', 'requested_books.book_id', '=', 'books.id')
            ->selectRaw('requested_books.course_id, SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles, books.year as book_year')
            ->groupBy('requested_books.course_id', 'books.year')
            ->orderBy('requested_books.course_id', 'asc')
            ->with('course')
            ->get();
            
            $groupedBooks = $books
            ->groupBy('course_id');
            
    
            $fiveYearsBelow = [$fiveYearsAgo->year, $sixYearsAgo->year, $sevenYearsAgo->year, $eightYearsAgo->year, $nineYearsAgo->year];
    
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];
    
            return view('programChair.reports', compact('books', 'groupedBooks', 'years', 'fiveYearsAgo', 'nextYear', 'fiveYearsBelow', 'ProgramCode'));
        }

        public function exportPdf(Request $request)
        {   
            $currentDate = Carbon::now();
            $nextYear = $currentDate->copy()->addYear();
            $nineYearsAgo = $currentDate->copy()->subYears(9);
            $eightYearsAgo = $currentDate->copy()->subYears(8);
            $sevenYearsAgo = $currentDate->copy()->subYears(7);
            $sixYearsAgo = $currentDate->copy()->subYears(6);
            $fiveYearsAgo = $currentDate->copy()->subYears(5);
            $fourYearsAgo = $currentDate->copy()->subYears(4);
            $threeYearsAgo = $currentDate->copy()->subYears(3);
            $twoYearsAgo = $currentDate->copy()->subYears(2);
            $oneYearsAgo = $currentDate->copy()->subYears(1);
            
            $pageSize = $request->input('page_size', 'a3');
            $orientation = $request->input('orientation', 'portrait');
            $ProgramCode = 'BSIT';
        
            // $books = RequestedBooks::selectRaw('year, course_id, SUM(volume) as total_volumes, COUNT(id) as total_titles')
            //     ->groupBy('year', 'course_id')
            //     ->orderBy('year', 'asc')
            //     ->orderBy('course_id', 'asc')
            //     ->with('course')
            //     ->get();
            $ProgramCode = Auth::user()->assigned_program;
            $books = RequestedBooks::where('program_name', $ProgramCode)
            ->where('status', 'Approved')
            ->join('books', 'requested_books.book_id', '=', 'books.id')
            ->selectRaw('requested_books.course_id, SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles, books.year as book_year')
            ->groupBy('requested_books.course_id', 'books.year')
            ->orderBy('requested_books.course_id', 'asc')
            ->with('course')
            ->get();
            
            $groupedBooks = $books
            ->groupBy('course_id');

            $courseGroupsssBooksTitle = $books
            ->groupBy('course.course_group');
            
            $fiveYearsBelow = [$fiveYearsAgo->year, $sixYearsAgo->year, $sevenYearsAgo->year, $eightYearsAgo->year, $nineYearsAgo->year];
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];

            // Load the PDF view and generate the PDF
            $pdf = PDF::loadView('pdfs', compact('books', 'groupedBooks','courseGroupsssBooksTitle', 'pageSize', 'orientation','nextYear', 'years', 'fiveYearsAgo', 'fiveYearsBelow', 'ProgramCode'))->setPaper($pageSize, $orientation);
        
            // Return the PDF for download
            return $pdf->stream('collection_report.pdf', ['Content-Type' => 'application/pdf']);
        }

        // public function pdf()
        // {
        //     $currentDate = Carbon::now();
        //     $nextYear = $currentDate->copy()->addYear();
        //     $nineYearsAgo = $currentDate->copy()->subYears(9);
        //     $eightYearsAgo = $currentDate->copy()->subYears(8);
        //     $sevenYearsAgo = $currentDate->copy()->subYears(7);
        //     $sixYearsAgo = $currentDate->copy()->subYears(6);
        //     $fiveYearsAgo = $currentDate->copy()->subYears(5);
        //     $fourYearsAgo = $currentDate->copy()->subYears(4);
        //     $threeYearsAgo = $currentDate->copy()->subYears(3);
        //     $twoYearsAgo = $currentDate->copy()->subYears(2);
        //     $oneYearsAgo = $currentDate->copy()->subYears(1);
        
        //     // $books = RequestedBooks::selectRaw('year, course_id, SUM(volume) as total_volumes, COUNT(id) as total_titles')
        //     //     ->groupBy('year', 'course_id')
        //     //     ->orderBy('year', 'asc')
        //     //     ->orderBy('course_id', 'asc')
        //     //     ->with('course')
        //     //     ->get();
        //     $ProgramCode = 'BSIT';
        //     // $books = RequestedBooks::all();

        //     $books = RequestedBooks::where('program_name', $ProgramCode)
        //     ->join('books', 'requested_books.book_id', '=', 'books.id')
        //     ->selectRaw('requested_books.course_id, SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles')
        //     ->groupBy('requested_books.course_id')
        //     ->with('course', 'book')
        //     ->get();    
        
            
        //         $groupedBooks = $books->groupBy('course_id');


                

                
           
    
        //     $fiveYearsBelow = [$fiveYearsAgo->year, $sixYearsAgo->year, $sevenYearsAgo->year, $eightYearsAgo->year, $nineYearsAgo->year];
    
        //     $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];
    
        //     return view('admin.CollectionProfile.collection', compact('books', 'groupedBooks', 'years', 'fiveYearsAgo', 'nextYear', 'fiveYearsBelow', 'ProgramCode'));
        // }
        
        public function cancelVerifyBook($id)
        {
            // Find the book tracking entry with the 'faculty' relationship eager-loaded
            $bookTracking = RequestedBooks::with('faculty')->where('id', $id)->first();
        
            if (!$bookTracking) {
                return redirect()->back()->with('error', 'Book not found');
            }
        
            $bookTracking->pg_id = null;
            $bookTracking->status = 'Selected';
            $bookTracking->verified_at = null;
            $bookTracking->save();
        
            // Return a response or redirect as needed
            return redirect()->back()->with('success', 'Book request approved successfully');
        }
}

        
