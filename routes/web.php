<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SOR_Controller;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CollectionProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        // User is logged in, redirect based on role
        $user = Auth::user();
        if ($user->role == '0') {
            return redirect()->route('home');
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
});

//Auth//
Route::get('licoms',[GoogleController::class, 'index'])->name('licoms');
Route::get('auth/google',[GoogleController::class, 'loginWithGoogle'])->name('login');
Route::any('auth/google/callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
Route::post('/logout', [GoogleController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/showBooks/{book}', [BookController::class, 'show'])->name('admin.books.show');
});

// Admin Panel Route//
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('home', function () {
        return view('admin.index');
    })->name('home');

    Route::get('/dashboard',[IndexController::class, 'index'])->name('admin.dashboard');

    // Summary of Records
    Route::get('/summaryRecords', [SOR_Controller::class, 'index'])->name('admin.SOR.index');

    // CollectionProfile
    Route::get('/collectionProfile', [CollectionProfileController::class, 'index'])->name('admin.CollectionProfile.index');

    // Programs
    Route::get('/programs', [ProgramController::class, 'index'])->name('admin.program.index');
    Route::get('/departments', [ProgramController::class, 'departmentIndex'])->name('admin.department.index');
    Route::get('/department/create', [ProgramController::class, 'create'])->name('admin.addDepartment');
    Route::post('/departmentAdded', [ProgramController::class, 'departmentStore'])->name('admin.department.store');
    Route::post('/courseAdded', [ProgramController::class, 'courseStore'])->name('admin.course.store');

    //Departements
    Route::get('/departments', [DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('/department/create', [DepartmentController::class, 'create'])->name('admin.addDepartments');
    Route::post('/departmentAddeds', [DepartmentController::class, 'departmentStoreIndex'])->name('admin.departments.store');
    Route::get('/departments/{program}/edit', [DepartmentController::class, 'edit'])->name('admin.department.edit');
    Route::put('/departments/{program}', [DepartmentController::class, 'update'])->name('admin.department.update');
    Route::delete('/departments/{program}', [DepartmentController::class, 'destroy'])->name('admin.department.destroy');

    // Courses //
    Route::get('/courses', [CourseController::class, 'index'])->name('admin.course.index');
    Route::post('/course-added', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('admin.course.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('admin.course.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('admin.course.destroy');



    // Books
    Route::get('/listBooks', [BookController::class, 'adminIndex'])->name('admin-books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::post('/books', [BookController::class, 'store'])->name('admin.books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('/allStatus', [BookController::class, 'allStatus'])->name('admin-books.allStatus');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('admin.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('admin.pendingBooks');
    Route::get('/rejectedBooks', [BookController::class, 'rejectedBooks'])->name('admin.rejectedBooks');
    Route::get('/requestBooks', [BookController::class, 'index'])->name('admin.request');

    // User type role
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
});

// Program-Chair Routes
Route::prefix('programChair')->middleware(['auth', 'programchair'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'pgIndex'])->name('program-chair.index');
    Route::get('/showBooks/{book}', [BookController::class, 'show'])->name('pg-books.show');
    Route::put('/updateStatus/{id}', [BookController::class, 'approveBook'])->name('pg-books.grant-status');
    Route::put('/cancelStatus/{id}', [BookController::class, 'rejectBook'])->name('pg-books.deny-status');
    Route::put('/pg-books/{id}/change-status', [BookController::class, 'changeStatus'])->name('pg-books.change-status');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('pg.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('pg.pendingBooks');
    Route::get('/requestBookss', [BookController::class, 'index'])->name('fac.request');
});

// Library Routes
Route::prefix('librarian')->middleware(['auth', 'librarian'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'librarianIndex'])->name('librarian.dashboard');
    Route::get('/Reports', [CollectionProfileController::class, 'index'])->name('lib-Reports');
    Route::get('/showBooks/{book}', [BookController::class, 'show'])->name('lib-books.show');
    Route::get('/books/{book}/edit', [BookController::class, 'libEdit'])->name('lib-books.edit');
    Route::put('/books/{book}', [BookController::class, 'libUpdate'])->name('lib-books.update');
    Route::put('/updateStatus/{id}', [BookController::class, 'grantBook'])->name('lib-books.grant-status');
    Route::put('/denyStatus/{id}', [BookController::class, 'denyBook'])->name('lib-books.deny-status');
    Route::put('/cancelStatus/{id}', [BookController::class, 'cancelGrant'])->name('lib-books.cancel-status');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('librarian.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('lib.pendingBooks');
});

// Faculty Routes
Route::prefix('faculty')->middleware(['auth', 'faculty'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'facultyIndex'])->name('faculty.dashboard');
    Route::get('/showBooksss/{book}', [BookController::class, 'show'])->name('fac-books.show');
    Route::post('/select-book/{id}', [BookController::class, 'selectBook'])->name('fac-select.book');
    Route::put('/cancelStatus/{id}', [BookController::class, 'cancelBook'])->name('fac-books.cancel-status');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('fac.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('fac.pendingBooks');
});

// Error message
Route::view('error', 'error/index')->name('error');
