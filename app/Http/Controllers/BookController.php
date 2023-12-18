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
use Illuminate\Support\Facades\Storage;





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
        return redirect('admin/listBooks')->with('checked', 'Book Added');
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

        $facId = Auth::id();

        $currentPrograms = json_decode($book->availabilty_program) ?? [];

        // Get the program code for the current faculty
        $facultyProgramCode = Auth::user()->assigned_program;

        // Check if the faculty program is in the current programs
        if (in_array($facultyProgramCode, $currentPrograms)) {
            // Remove the program from the array
            $currentPrograms = array_values(array_diff($currentPrograms, [$facultyProgramCode]));

            // Update the book's availability_program attribute
            $book->availabilty_program = json_encode($currentPrograms);
            $book->save();
        }
    
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
    public function pcIndex()
    {
        $user = Auth::user();
        $programId = $user->assigned_program;

        $currentDate = Carbon::now();
    
        $books = RequestedBooks::where('program_name', $programId)->get();
        
        $approvedBooks = RequestedBooks::where('status', 'Approved')
        ->where('program_name', $programId)->get();

        $pendingBooks = RequestedBooks::whereIn('status', ['Verified', 'Selected'])
        ->where('program_name', $programId)->get();

        $prescribedYears = range($currentDate->copy()->subYears(4)->year, $currentDate->year);
            $requestedBooksByYear = RequestedBooks::join('books', 'requested_books.book_id', '=', 'books.id')
            ->selectRaw('books.year, COUNT(requested_books.id) as title_count')
            ->whereIn('books.year', $prescribedYears) // Filter by the last 4 years
            ->where('requested_books.status', 'Approved')
            ->where('requested_books.program_name', $programId)
            ->groupBy('books.year')
            ->orderBy('books.year', 'asc')
            ->get();
            $resultArray = [];

    // Initialize the array with all years and set title count to 0
    foreach ($prescribedYears as $year) {
        $resultArray[$year] = 0;
    }

    // Fill in the actual title counts for existing years
    foreach ($requestedBooksByYear as $result) {
        $year = $result->year;
        $resultArray[$year] = $result->title_count;
    }



        return view('programChair.index', compact('books', 'approvedBooks', 'pendingBooks', 'prescribedYears', 'resultArray'));
    }
    public function pcBookEvaluation()
    {
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        // Retrieve requested books for the same program as the program chair   
        $requestedBooks = RequestedBooks::where('program_name', $programId)
                                        ->where('status', 'Selected')
                                        ->get();

                                        $courses = Course::whereHas('program', function ($query) use ($programId) {
                                            $query->where('assigned_program', $programId);
                                        })->get();
    
        return view('programChair.book_evaluation', compact('requestedBooks', 'courses'));
    }

    public function editCourseCode(Request $request, $id)
    {

    
        // Retrieve requested books for the same program as the program chair   
        $requestedBooks = RequestedBooks::find($id);
        
        $requestedBooks->update([
            'course_id' => $request->input('course_id'),
        ]);
    
        return redirect()->back()->with('checked', 'Updated successfully');
    }




    
    

    public function facultyIndex()
    {
        $user = Auth::user();
        $programId = $user->assigned_program;

        $currentDate = Carbon::now();
    
        $books = RequestedBooks::where('program_name', $programId)->get();
        
        $approvedBooks = RequestedBooks::where('status', 'Approved')
        ->where('program_name', $programId)->get();

        $pendingBooks = RequestedBooks::whereIn('status', ['Verified', 'Selected'])
        ->where('program_name', $programId)->get();

        $prescribedYears = range($currentDate->copy()->subYears(4)->year, $currentDate->year);
            $requestedBooksByYear = RequestedBooks::join('books', 'requested_books.book_id', '=', 'books.id')
            ->selectRaw('books.year, COUNT(requested_books.id) as title_count')
            ->whereIn('books.year', $prescribedYears) // Filter by the last 4 years
            ->where('requested_books.status', 'Approved')
            ->where('requested_books.program_name', $programId)
            ->groupBy('books.year')
            ->orderBy('books.year', 'asc')
            ->get();
            $resultArray = [];

            // Initialize the array with all years and set title count to 0
            foreach ($prescribedYears as $year) {
                $resultArray[$year] = 0;
            }

            // Fill in the actual title counts for existing years
            foreach ($requestedBooksByYear as $result) {
                $year = $result->year;
                $resultArray[$year] = $result->title_count;
            }

        return view('faculty.index', compact('books', 'approvedBooks', 'pendingBooks', 'prescribedYears', 'resultArray'));
    }
    public function facultyBookEvaluation()
    {
        $user = Auth::user();
        $programId = $user->assigned_program;

        $books = Book::where(function ($query) use ($programId) {
            $query->whereNull('program_hidden')
                ->orWhereJsonDoesntContain('program_hidden', $programId);
        })
        ->where(function ($query) use ($programId) {
            $query->whereNull('availabilty_program')
                ->orWhereJsonDoesntContain('availabilty_program', $programId);
        })
        ->where(function ($query) use ($programId) {
            $query->whereNull('program_hide_request')
                ->orWhereJsonDoesntContain('program_hide_request', $programId);
        })
        ->get();
    
    
        $courses = Course::whereHas('program', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();

        return view('faculty.book-evaluation', compact('books', 'courses'));
    }

    public function ignoreBook($id)
    {   
            $user = Auth::user();
            $programId = $user->assigned_program;
            $book = Book::find($id);
            // Retrieve the current value of program_hide_request
            $currentPrograms = json_decode($book->program_hidden) ?? [];
        
            // Check if the program is not already present in the programs array
            if (!in_array($programId, $currentPrograms)) {
                $currentPrograms[] = $programId;
        
                // Update the book's program_hide_request attribute
                $book->program_hidden = json_encode($currentPrograms);
                $book->save();
            }

            return redirect()->back()->with('success', 'The book has been ignored');
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
    public function ignoredBooks()
    {   
        $user = Auth::user();
        $programId = $user->assigned_program;
    
        // Retrieve books where 'program_hide_request' contains the programId
        // and 'program_hidden' does not contain the programId
        $books = Book::whereJsonContains('program_hidden', $programId)
                     ->get();
    
        // Retrieve courses related to the program
        $courses = Course::whereHas('program', function ($query) use ($programId) {
            $query->where('assigned_program', $programId);
        })->get();
    
        return view('faculty.ignoredBooks', compact('books', 'courses'));
    }
    
    
    

    
    public function undoIgnoredBook($id)
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
        $programIgnoredBooks = json_decode($book->program_hidden, true);
    
        // Check if the program ID exists in the JSON array
        if (is_array($programIgnoredBooks) && in_array($programId, $programIgnoredBooks)) {
            // Remove the program ID from the JSON array
            $programIgnoredBooks = array_diff($programIgnoredBooks, [$programId]);
    
            // Update the 'program_hidden' column with the modified JSON array
            Book::where('id', $id)->update(['program_hidden' => json_encode(array_values($programIgnoredBooks))]);
    
            return redirect()->back()->with('success', 'The Book is now visible in Book Evaulation');
        }
    
        return redirect()->back()->with('error', 'Unable to unhide the book');
    }
    
    

    public function listBooksApproval($param)
    {
        $programId = $param;

        $books = Book::orderBy('title', 'asc')
        ->where(function ($query) use ($programId) {
            $query->whereNull('program_hidden')
                ->orWhereJsonDoesntContain('program_hidden', $programId);
        })
        ->where(function ($query) use ($programId) {
            $query->whereNull('availabilty_program')
                ->orWhereJsonDoesntContain('availabilty_program', $programId);
        })
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

        return view('librarian.book_list_approval', compact('books', 'courses', 'programId'));
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

    public function libPendingBooks()
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
        $programId = $user->assigned_department;
        $programs = Program::where('department', $programId)->orderBy('name')->pluck('name')
        ->all();

        $programCounts = [];

        foreach ($programs as $program) {
            $count = RequestedBooks::where('status', 'Approved')
                ->where('program_name', $program)
                ->count();

            $programCounts[$program] = $count;
        }

        $totalNotedBooks = RequestedBooks::where('status', 'Approved')
        ->whereIn('program_name', $programs)
        ->count();

        $totalPendingBooks = RequestedBooks::whereIn('status', ['Selected', 'Verified'])
        ->whereIn('program_name', $programs)
        ->count();

        $activeCollection = RequestedBooks::whereIn('program_name', $programs)
        ->join('books', 'requested_books.book_id', '=', 'books.id')
        ->selectRaw('books.*')
        ->where('status', 'Selected')
            ->get();

            foreach ($activeCollection as $resultss) {
            $resultss->year;
            }

        $activeCollections = $activeCollection->where('year', '>=', date('Y') - 5)->count();

        $user = Auth::user();
        $programId = $user->assigned_program;

        $currentDate = Carbon::now();
    

        $pendingBooks = RequestedBooks::whereIn('status', ['Verified', 'Selected'])
        ->where('program_name', $programId)->get();




        return view('librarian.index', compact('activeCollections', 'totalPendingBooks', 'totalNotedBooks', 'pendingBooks', 'programs', 'programCounts'));
    }
    public function librarianBookEvaluation()
    {   
        $user = Auth::user();
        $programId = $user->assigned_department;
        $programs = Program::where('department', $programId)->get();

        $requestedBooks = RequestedBooks::whereIn('program_name', $programs->pluck('name'))
        ->whereIn('status', ['Verified', 'Selected'])
        ->get();

        $book = Book::all();

        return view('librarian.book-evaluation', compact('requestedBooks', 'book', 'programs'));
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
    public function librarianApprovedBooks(Request $request)
    {   
        $programName = $request->input('param');
    
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
        
        $groupedBooksss = RequestedBooks::where('program_name', $programName)
        ->where('status', 'Approved')
        ->join('courses', 'requested_books.course_id', '=', 'courses.course_code')
        ->join('books', 'requested_books.book_id', '=', 'books.id')
        ->selectRaw('courses.*, books.*, requested_books.*, requested_books.id as requested_book_id')
        ->get();


        $organizeBook = $groupedBooksss
        ->groupBy('course_title');
            // dd($organizeBook);   
        // Get all courses (assuming 'Course' is an Eloquent model)
        $courses = Course::whereHas('program', function ($query) use ($programName) {
            $query->where('assigned_program', $programName);
        })->get();
    
        // Return the view 'others.allUsers.approvedBooks' with the data 'requestedBooks', 'user', and 'courses'
        return view('others.allUsers.approvedBooksLib', compact('requestedBooks', 'courses', 'organizeBook', 'programName'));
    }
    public function exportBooks(Request $request)
    {   
        $programName = $request->input('param');
        $pageSize = $request->input('page_size', 'a3');
        $orientation = $request->input('orientation', 'portrait');

        $groupedBooksss = RequestedBooks::where('program_name', $programName)
        ->where('status', 'Approved')
        ->join('courses', 'requested_books.course_id', '=', 'courses.course_code')
        ->join('books', 'requested_books.book_id', '=', 'books.id')
        ->selectRaw('courses.*, books.*, requested_books.*, requested_books.id as requested_book_id')
        ->get();


        $organizeBook = $groupedBooksss
        ->groupBy('course_title');

                    // Load the PDF view and generate the PDF
        $pdf = PDF::loadView('others.export.notedBookExport', compact('programName','organizeBook', 'pageSize', 'orientation'))->setPaper($pageSize, $orientation);
        
                    // Return the PDF for download
         return $pdf->stream('Noted_Books.pdf', ['Content-Type' => 'application/pdf']);
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


    public function libRefuseBookRequest(RequestedBooks $requestedBook)
    {

        $book = $requestedBook->book;
        $currentPrograms = json_decode($book->availabilty_program) ?? [];

        // Get the program code for the current faculty
        $ProgramCode = $requestedBook->program_name;

        // Check if the faculty program is in the current programs
        if (in_array($ProgramCode, $currentPrograms)) {
            // Remove the program from the array
            $currentPrograms = array_values(array_diff($currentPrograms, [$ProgramCode]));

            // Update the book's availability_program attribute
            $book->availabilty_program = json_encode($currentPrograms);
            $book->save();
        }
    
        // Delete the book request
        $requestedBook->delete();


        // $usersWithSameProgram = User::where('assigned_program', $ProgramCode)->get();
        // foreach ($usersWithSameProgram as $user) {
        //     $user->notify(new BookRejectedNotification($requestedBook));
        // }

        return redirect()->back()->with('checked', 'Book request has been refued successfully');

    }

    public function PCrefuseBookRequest(RequestedBooks $requestedBook)
    {

        $book = $requestedBook->book;
        $currentPrograms = json_decode($book->availabilty_program) ?? [];

        // Get the program code for the current faculty
        $ProgramCode = Auth::user()->assigned_program;

        // Check if the faculty program is in the current programs
        if (in_array($ProgramCode, $currentPrograms)) {
            // Remove the program from the array
            $currentPrograms = array_values(array_diff($currentPrograms, [$ProgramCode]));

            // Update the book's availability_program attribute
            $book->availabilty_program = json_encode($currentPrograms);
            $book->save();
        }
    
        // Delete the book request
        $requestedBook->delete();


        // $usersWithSameProgram = User::where('assigned_program', $ProgramCode)->get();
        // foreach ($usersWithSameProgram as $user) {
        //     $user->notify(new BookRejectedNotification($requestedBook));
        // }

        return redirect()->back()->with('checked', 'Book request has been refued successfully');

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
        
        $book = Book::find($id);

        // Check if the book exists
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        $currentPrograms = json_decode($book->availabilty_program) ?? [];
        if (empty($courseCode)) {
            return redirect()->back()->with('error', 'Course code is required.');
        }
        $facId = Auth::id();
        $currentPrograms = json_decode($book->availabilty_program) ?? [];
    
        // Get the program code for the current faculty
        $facultyProgramCode = Auth::user()->assigned_program;
        
        if (!in_array($facultyProgramCode, $currentPrograms)) {
            $currentPrograms[] = $facultyProgramCode;
    
            // Update the book's availability_program attribute
            $book->availabilty_program = json_encode($currentPrograms);
            $book->save();
        }

    
        // Create a new entry in the RequestedBooks table
        $requestedBook = new RequestedBooks();
        $requestedBook->book_id = $id;
        $requestedBook->course_id = $courseCode;
        $requestedBook->fac_id = $facId;
        $requestedBook->status = 'Selected';
        $requestedBook->program_name = $facultyProgramCode;

    
        $requestedBook->save();
    
        // Notify users with the same assigned_program
        $usersWithSameProgram = User::where('assigned_program', $facultyProgramCode)->get();
        foreach ($usersWithSameProgram as $user) {
            $user->notify(new BookSelectNotification($requestedBook));
        }
    
        return redirect()->back()->with('checked', 'Book has been selected successfully.');
    }    
    
    public function autoApprovedBook(Request $request, $id) 
    {
        $courseCode = $request->input('course_code');
        $libId = Auth::id();
        $book = Book::find($id);
        $ProgramCode = $request->input('param');
        
        $currentPrograms = json_decode($book->availabilty_program) ?? [];
        if (empty($courseCode)) {
            return redirect()->back()->with('error', 'Course code is required.');
        }
        $currentPrograms = json_decode($book->availabilty_program) ?? [];
    
        
        if (!in_array($ProgramCode, $currentPrograms)) {
            $currentPrograms[] = $ProgramCode;
    
            // Update the book's availability_program attribute
            $book->availabilty_program = json_encode($currentPrograms);
            $book->save();
        }
        
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
        $requestedBook->lib_id = $libId;
        $requestedBook->status = 'Approved';
        $requestedBook->program_name = $ProgramCode;
        $requestedBook->approved_at = now();
    
        $requestedBook->save();

    
        // Notify users with the same assigned_program
        $usersWithSameProgram = User::where('assigned_program', $ProgramCode)->get();
        foreach ($usersWithSameProgram as $user) {
            $user->notify(new BookApprovalNotification($requestedBook));
        }
    
        return redirect()->back()->with('checked', 'Book has been approved successfully');
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
        return redirect()->back()->with('checked', 'Book request verified successfully');
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

        public function report(Request $request)
        {   
            $param = $request->input('param');
            $currentDate = Carbon::now();
            $nextYear = $currentDate->copy()->addYear();
            $fiveYearsAgo = $currentDate->copy()->subYears(5);
            $fourYearsAgo = $currentDate->copy()->subYears(4);
            $threeYearsAgo = $currentDate->copy()->subYears(3);
            $twoYearsAgo = $currentDate->copy()->subYears(2);
            $oneYearsAgo = $currentDate->copy()->subYears(1);
            $fiveYearsBelow = range(1985, $currentDate->copy()->subYears(5)->year);
            

            $ProgramCode = $param;
            $minimumreq = RequestedBooks::join('programs', 'requested_books.program_name', '=', 'programs.name')
            ->select('requested_books.*', 'programs.minimum_req')
            ->pluck('minimum_req')->first();
            
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
            // $groupedBooks = $books
            // ->join('books', 'requested_books.book_id', '=', 'books.title');
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];

            $courseGroupsssBooksTitle = $books
            ->whereIn('book_year', $years)
            ->groupBy('course.course_group');
    

            
            return view('admin.CollectionProfile.collection', compact('minimumreq', 'books', 'groupedBooks', 'courseGroupsssBooksTitle', 'years', 'param', 'fiveYearsAgo', 'nextYear', 'fiveYearsBelow', 'ProgramCode'));
        }
        public function librarianReport(Request $request)
        {   
            $param = $request->input('param');
            $currentDate = Carbon::now();
            $nextYear = $currentDate->copy()->addYear();
            $fiveYearsAgo = $currentDate->copy()->subYears(5);
            $fourYearsAgo = $currentDate->copy()->subYears(4);
            $threeYearsAgo = $currentDate->copy()->subYears(3);
            $twoYearsAgo = $currentDate->copy()->subYears(2);
            $oneYearsAgo = $currentDate->copy()->subYears(1);
            $fiveYearsBelow = range(1985, $currentDate->copy()->subYears(5)->year);

            $ProgramCode = $param;
            $minimumreq = RequestedBooks::join('programs', 'requested_books.program_name', '=', 'programs.name')
            ->select('requested_books.*', 'programs.minimum_req')
            ->pluck('minimum_req')->first();
            
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

            // $courseGroupsssBooksTitle = $books
            // ->groupBy('course.course_group');
    
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];

                $courseGroupsssBooksTitle = $books
                ->whereIn('book_year', $years)
                ->groupBy('course.course_group');
            
            return view('admin.CollectionProfile.collection', compact('minimumreq', 'books', 'groupedBooks', 'courseGroupsssBooksTitle', 'years', 'param', 'fiveYearsAgo', 'nextYear', 'fiveYearsBelow', 'ProgramCode'));
        }
        public function ProgramChairreport()
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
            $fiveYearsBelow = range(1985, $currentDate->copy()->subYears(5)->year);
            
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

            $minimumreq = RequestedBooks::join('programs', 'requested_books.program_name', '=', 'programs.name')
            ->select('requested_books.*', 'programs.minimum_req')
            ->pluck('minimum_req')->first();
    
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];

            $courseGroupsssBooksTitle = $books
            ->whereIn('book_year', $years)
            ->groupBy('course.course_group');
    
            return view('programChair.reports', compact('minimumreq', 'books', 'groupedBooks', 'courseGroupsssBooksTitle', 'years', 'fiveYearsAgo', 'nextYear', 'fiveYearsBelow', 'ProgramCode'));
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
            $fiveYearsBelow = range(1985, $currentDate->copy()->subYears(5)->year);
            
        
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
            
    
    
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];
    
            return view('programChair.reports', compact('books', 'groupedBooks', 'years', 'fiveYearsAgo', 'nextYear', 'fiveYearsBelow', 'ProgramCode'));
        }

        

        public function exportPdf(Request $request)
        {
            $param = $request->input('param');
            $currentDate = Carbon::now();
            $nextYear = $currentDate->copy()->addYear();
            $fiveYearsAgo = $currentDate->copy()->subYears(5);
            $fourYearsAgo = $currentDate->copy()->subYears(4);
            $threeYearsAgo = $currentDate->copy()->subYears(3);
            $twoYearsAgo = $currentDate->copy()->subYears(2);
            $oneYearsAgo = $currentDate->copy()->subYears(1);
            $fiveYearsBelow = range(1990, $currentDate->copy()->subYears(5)->year);

            $pageSize = $request->input('page_size', 'a3');
            $orientation = $request->input('orientation', 'portrait');
            $ProgramCode = $param;
        
            $books = RequestedBooks::where('program_name', $ProgramCode)
            ->where('status', 'Approved')
            ->join('books', 'requested_books.book_id', '=', 'books.id')
            ->selectRaw('requested_books.course_id, SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles, books.year as book_year')
            ->groupBy('requested_books.course_id', 'books.year')
            ->orderBy('requested_books.course_id', 'asc')
            ->with('course')
            ->get();

            $minimumreq = RequestedBooks::join('programs', 'requested_books.program_name', '=', 'programs.name')
            ->select('requested_books.*', 'programs.minimum_req')
            ->pluck('minimum_req')->first();
            
            $groupedBooks = $books
            ->groupBy('course_id');
 
            $total = RequestedBooks::where('program_name', $ProgramCode)
            ->where('status', 'Approved')
            ->join('books', 'requested_books.book_id', '=', 'books.id')
            ->selectRaw('SUM(books.volume) as total_volumes, COUNT(requested_books.id) as total_titles')
            ->first();


            
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];
            $courseGroupsssBooksTitle = $books
            ->whereIn('book_year', $years)
            ->groupBy('course.course_group');
            // Load the PDF view and generate the PDF
            $pdf = PDF::loadView('pdfs', compact( 'total','minimumreq', 'books', 'groupedBooks','courseGroupsssBooksTitle', 'pageSize', 'orientation','nextYear', 'years', 'fiveYearsAgo', 'fiveYearsBelow', 'ProgramCode'))->setPaper($pageSize, $orientation);
        
            // Return the PDF for download
            return $pdf->stream('collection_report.pdf', ['Content-Type' => 'application/pdf']);
        }
        
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
            return redirect()->back()->with('success', 'Book has been evaluation process again');
        }

        public function bookListTemplate(){
            
            {
                try {
                    $myTemplate = storage_path('app/public/template/BookFormat.xlsx');
            
                    // Set headers for Excel download
                    $headers = [
                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'Content-Disposition' => 'attachment; filename="BookFormat.xlsx"',
                    ];
            
                    return response()->download($myTemplate, 'BookFormat.xlsx', $headers);
            
                } catch (\Throwable $th) {
                    // Handle exceptions as needed
                    throw $th;
                }
            }


        }
            public function ignoreRequest($id){
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

                    return redirect()->back()->with('success', 'Your request to ignore the book has been sent to the Program Chair.');
            }
            
            
        }
        public function libIgnoreRequest(Request $request, $id){
            {   
                $programId = $request->input('param');
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

                return redirect()->back()->with('success', 'Your request to ignore the book has been sent to the Program Chair.');
        }
    }

            public function ignoredRequest(){
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
            
                return view('faculty.ignoreRequestBook', compact('books', 'courses'));
            }
            public function PCignoredRequest(){
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
            
                return view('programChair.ignoreRequestBook', compact('books', 'courses'));
            }
            public function undoIgnoreRequestBook($id)
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
                $programIgnoredBooks = json_decode($book->program_hide_request, true);
            
                // Check if the program ID exists in the JSON array
                if (is_array($programIgnoredBooks) && in_array($programId, $programIgnoredBooks)) {
                    // Remove the program ID from the JSON array
                    $programIgnoredBooks = array_diff($programIgnoredBooks, [$programId]);
            
                    // Update the 'program_hide_request' column with the modified JSON array
                    Book::where('id', $id)->update(['program_hide_request' => json_encode(array_values($programIgnoredBooks))]);
            
                    return redirect()->back()->with('success', 'The Book is now visible again');
                }
            
                return redirect()->back()->with('error', 'Unable to unhide the book');
            }
            public function confirmIgnoreRequestBook($id)
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
            
                $programIgnoredBooks = json_decode($book->program_hide_request, true);
                $otherField = json_decode($book->program_hidden, true);
                
                // Check if the program ID exists in the JSON array
                if (is_array($programIgnoredBooks) && in_array($programId, $programIgnoredBooks)) {
                    // Remove the program ID from both JSON arrays
                    $programIgnoredBooks = array_diff($programIgnoredBooks, [$programId]);
                    $otherField = array_diff($otherField, [$programId]);
                
                    // Update both columns with the modified JSON arrays
                    Book::where('id', $id)->update([
                        'program_hide_request' => json_encode(array_values($programIgnoredBooks)),
                        'program_hidden' => json_encode(array_values($otherField))
                    ]);
                
                    return redirect()->back()->with('success', 'The Book is now visible again');
                }
                
            
                return redirect()->back()->with('error', 'Unable to unhide the book');
            }
            public function PCrefuseIgnoreRequestBook($id)
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
                $programIgnoredBooks = json_decode($book->program_hide_request, true);
            
                // Check if the program ID exists in the JSON array
                if (is_array($programIgnoredBooks) && in_array($programId, $programIgnoredBooks)) {
                    // Remove the program ID from the JSON array
                    $programIgnoredBooks = array_diff($programIgnoredBooks, [$programId]);
            
                    // Update the 'program_hide_request' column with the modified JSON array
                    Book::where('id', $id)->update(['program_hide_request' => json_encode(array_values($programIgnoredBooks))]);
            
                    return redirect()->back()->with('success', 'The Book is now visible again');
                }
            
                return redirect()->back()->with('error', 'Unable to unhide the book');
            }
            public function sampleReport(Request $request)
        {   
            $param = 'BSIT';
            $currentDate = Carbon::now();
            $nextYear = $currentDate->copy()->addYear();
            $fiveYearsAgo = $currentDate->copy()->subYears(5);
            $fourYearsAgo = $currentDate->copy()->subYears(4);
            $threeYearsAgo = $currentDate->copy()->subYears(3);
            $twoYearsAgo = $currentDate->copy()->subYears(2);
            $oneYearsAgo = $currentDate->copy()->subYears(1);
            $fiveYearsBelow = range(1985, $currentDate->copy()->subYears(5)->year);
            

            $ProgramCode = $param;
            $minimumreq = RequestedBooks::join('programs', 'requested_books.program_name', '=', 'programs.name')
            ->select('requested_books.*', 'programs.minimum_req')
            ->pluck('minimum_req')->first();
            
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
            // $groupedBooks = $books
            // ->join('books', 'requested_books.book_id', '=', 'books.title');
            $years = [$fourYearsAgo->year, $threeYearsAgo->year, $twoYearsAgo->year, $oneYearsAgo->year, $currentDate->year, $nextYear->year];

            $courseGroupsssBooksTitle = $books
            ->whereIn('book_year', $years)
            ->groupBy('course.course_group');
            $additionalPercentage = 0;
            $TotalresultPercentage = 0;
            $grandTotalresultPercentage = 0;
            $totalAdditionalPercentage = 0;
            $rowCount = 0;
            foreach ($groupedBooks as $courseId => $courseGroup){
                $grandTotalTitles = 0;
                $grandTotalVolumes = 0;
                $rowCount++;
                foreach (array_reverse($years) as $year){
                        $totalTitles = 0;
                        $totalVolumes = 0;
                        $lastYearToRemoveData = reset($years);
                    foreach ($courseGroup as $book){
                        if ($book->book_year == $year){
                                $totalTitles += $book->total_titles;
                                $totalVolumes += $book->total_volumes;
                        }
                    }   
                        $grandTotalTitles += $totalTitles;
                        $grandTotalVolumes += $totalVolumes;
                        $result = ($grandTotalTitles >= $minimumreq) ? 100 : ($grandTotalTitles * 20);

                        $excessTitles = ($grandTotalTitles >= $minimumreq) ? ($grandTotalTitles - $minimumreq) : 0;

                        if ($excessTitles > 0) {
                            // Calculate the excessTitles percentage
                            $percentage = ($excessTitles <= $minimumreq) ? ($excessTitles * 20) : 100;
                        } else {
                            $percentage = 0;
                        }
                
                }
                $additionalPercentage += $percentage;
                $TotalresultPercentage += $result;
                $grandTotalresultPercentage = $TotalresultPercentage / $rowCount;
                $totalAdditionalPercentage = $additionalPercentage / $rowCount;

                }

                $compiledPercentage = $grandTotalresultPercentage + $totalAdditionalPercentage;

            
            return view('admin.CollectionProfile.sample', compact('compiledPercentage', 'minimumreq', 'books', 'groupedBooks', 'courseGroupsssBooksTitle', 'years', 'param', 'fiveYearsAgo', 'nextYear', 'fiveYearsBelow', 'ProgramCode'));
        }
    }
    