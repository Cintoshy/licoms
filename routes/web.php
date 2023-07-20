<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SOR_Controller;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CollectionProfileController;
use App\Http\Controllers\IndexController;
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

    // Books
    Route::get('/listBooks', [BookController::class, 'adminIndex'])->name('admin-books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::post('/books', [BookController::class, 'store'])->name('admin.books.store');
    Route::get('/showBooks/{book}', [BookController::class, 'show'])->name('admin.books.show');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('/allStatus', [BookController::class, 'allStatus'])->name('admin-books.allStatus');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('admin.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('admin.pendingBooks');
    Route::get('/rejectedBooks', [BookController::class, 'rejectedBooks'])->name('admin.rejectedBooks');

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
    Route::put('/updateStatus/{id}', [BookController::class, 'approveBook'])->name('pg-books.grant-status');
    Route::put('/cancelStatus/{id}', [BookController::class, 'rejectBook'])->name('pg-books.deny-status');
    Route::put('/pg-books/{id}/change-status', [BookController::class, 'changeStatus'])->name('pg-books.change-status');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('pg.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('pg.pendingBooks');
});

// Library Routes
Route::prefix('librarian')->middleware(['auth', 'librarian'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'librarianIndex'])->name('librarian.dashboard');
    Route::put('/updateStatus/{id}', [BookController::class, 'grantBook'])->name('lib-books.grant-status');
    Route::put('/denyStatus/{id}', [BookController::class, 'denyBook'])->name('lib-books.deny-status');
    Route::put('/cancelStatus/{id}', [BookController::class, 'cancelGrant'])->name('lib-books.cancel-status');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('librarian.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('lib.pendingBooks');
});

// Faculty Routes
Route::prefix('faculty')->middleware(['auth', 'faculty'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'facultyIndex'])->name('faculty.dashboard');
    Route::put('/updateStatus/{id}', [BookController::class, 'selectBook'])->name('fac-books.update-status');
    Route::put('/cancelStatus/{id}', [BookController::class, 'cancelBook'])->name('fac-books.cancel-status');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('fac.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('fac.pendingBooks');
});

// Error message
Route::view('error', 'error/index')->name('error');
