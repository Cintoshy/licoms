<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SOR_Controller;
use App\Http\Controllers\AddProgramController;
use App\Http\Controllers\CollectionProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseGroupController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\BookTrackingNotification;
use App\Http\Controllers\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Models\RequestedBooks;
use App\Models\CourseGroup;
use Illuminate\Notifications\DatabaseNotification;


Route::get('/', function () {
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
});

//Auth//
Route::get('/profile', function () {
    return view('profile');
});

    

    Route::get('licoms', [GoogleController::class, 'index'])->name('licoms');
    Route::get('auth/google', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('auth/google/callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
    Route::post('/logout', [GoogleController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/confirmLogout', [SOR_Controller::class, 'wewe'])->name('confirmLogout');
    Route::get('/cancelLogoutSession', [SOR_Controller::class, 'cancelLogoutSession'])->name('cancelLogoutSession');
    Route::get('/showBooks/{book}', [BookController::class, 'show'])->name('admin.books.show');
    Route::get('/showApprovedBook/{approvedBook}', [BookController::class, 'showApprovedBookPage'])->name('all.approvedBookPage.show');
    Route::get('/showApprovedBook/{approvedBook}/{notificationId}', [BookTrackingNotification::class, 'showApprovedNotif'])->name('all.approvedBooks.show');
    Route::get('/showGrantedBook/{grantedBook}/{notificationId}', [BookTrackingNotification::class, 'showGrantedNotif'])->name('all.grantedBooks.show');
    Route::get('/showSelectedBook/{selectedBook}/{notificationId}', [BookTrackingNotification::class, 'showSelectedNotif'])->name('all.selectedBooks.show');
    Route::get('/showRejectedBook/{rejectedBook}/{notificationId}', [BookTrackingNotification::class, 'showRejectedNotif'])->name('all.rejectedBooks.show');
    Route::get('/mark-all-as-read', [BookTrackingNotification::class, 'markAllAsRead'])->name('markAllAsRead');
    Route::post('/export-collection', [BookController::class, 'exportPdf'])->name('export.collection-profile');

});

// Admin Panel Route//
Route::prefix('admin')->middleware(['auth', 'admin', 'cache'])->group(function () {


        Route::get('/dashboard',[IndexController::class, 'index'])->name('admin.dashboard');

    // Summary of Records
    Route::get('/summaryRecords', [SOR_Controller::class, 'index'])->name('admin.SOR.index');
    Route::get('/Summary-of-Recods', [SOR_Controller::class, 'summaryRecords'])->name('admin.SOR.summaryRecords');

    // CollectionProfile
    Route::get('/collectionProfile', [BookController::class, 'report'])->name('admin.CollectionProfile.index');
    Route::get('/listOfDepartments', [CollectionProfileController::class, 'listDepartments'])->name('admin.listDepartments.index');


    // Course Group
    Route::get('/courseGroups', [CourseGroupController::class, 'index'])->name('admin.courseGroup.index');
    Route::post('/courseGroup-added', [CourseGroupController::class, 'store'])->name('admin.courseGroup.store');
    Route::get('/courseGroup/{courseGroup}/edit', [CourseGroupController::class, 'edit'])->name('admin.courseGroup.edit');
    Route::put('/courseGroup/{courseGroup}', [CourseGroupController::class, 'update'])->name('admin.courseGroup.update');
    Route::delete('/courseGroup/{courseGroup}', [CourseGroupController::class, 'destroy'])->name('admin.courseGroup.destroy');

    //Departments
    Route::get('/departments', [DepartmentController::class, 'index'])->name('admin.department.index');
    Route::get('/department/create', [DepartmentController::class, 'create'])->name('admin.adddepartments');
    Route::post('/department-added', [DepartmentController::class, 'store'])->name('admin.department.store');
    Route::get('/department/{department}/edit', [DepartmentController::class, 'edit'])->name('admin.department.edit');
    Route::put('/department/{department}', [DepartmentController::class, 'update'])->name('admin.department.update');
    Route::delete('/department/{department}', [DepartmentController::class, 'destroy'])->name('admin.department.destroy');

    //Programs
    Route::get('/programs', [ProgramController::class, 'index'])->name('admin.program.index');
    Route::get('/program/create', [ProgramController::class, 'create'])->name('admin.addprograms');
    Route::post('/program-added', [ProgramController::class, 'store'])->name('admin.program.store');
    Route::get('/program/{program}/edit', [ProgramController::class, 'edit'])->name('admin.program.edit');
    Route::put('/program/{program}', [ProgramController::class, 'update'])->name('admin.program.update');
    Route::delete('/program/{program}', [ProgramController::class, 'destroy'])->name('admin.program.destroy');

    // Courses //

    Route::get('/courses', [CourseController::class, 'index'])->name('admin.course.index');
    Route::get('/courses/filter', [CourseController::class, 'index'])->name('admin.course.filter');
    Route::post('/course-added', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('admin.course.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('admin.course.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('admin.course.destroy');
    Route::get('/CCSsss', [CourseController::class, 'CCS'])->name('admin.CCS.index');



    // Books
    Route::get('/export-courses', [BookController::class, 'exportCourses'])->name('export.courses');
    Route::get('/listBooks', [BookController::class, 'adminIndex'])->name('admin-books.index');
    Route::get('/books/filter', [BookController::class, 'adminIndex'])->name('admin.books.filter');
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
    Route::get('/user/{employee}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');


    Route::get('/import',  [ImportController::class, 'showImportForm'])->name('import.form');
    Route::post('/import',  [ImportController::class, 'import'])->name('import');
});

// Program-Chair Routes
Route::prefix('programChair')->middleware(['auth', 'programchair', 'cache'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'pcIndex'])->name('program-chair.index');
    Route::get('/bookEvaulation', [BookController::class, 'pcBookEvaluation'])->name('program-chair.book-evaluation');
    Route::get('/hideRequest', [BookController::class, 'ProgramHideRequest'])->name('pg.hideRequest');
    Route::put('/books/{id}', [BookController::class, 'acceptHideRequest'])->name('pg.acceptHideRequest');
    Route::get('/refuseHideRequest{id}', [BookController::class, 'RefuseHideRequest'])->name('pg.RefuseHideRequest');
    Route::get('/collectionProfile', [BookController::class, 'ProgramChairreport'])->name('pg.reports');
    Route::get('/showBooks/{book}', [BookController::class, 'show'])->name('pg-books.show');
    Route::put('/pg-books/{id}/change-status', [BookController::class, 'changeStatus'])->name('pg-books.change-status');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('pg.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('pg.pendingBooks');
    Route::get('/requestBookss', [BookController::class, 'index'])->name('fac.request');
    Route::get('/activityLogs', [ActivityLog::class, 'pgActivityLog'])->name('pgActivityLogs');
    Route::put('/updateStatus/{id}', [BookController::class, 'verified'])->name('pg-books.verified-status');
    Route::put('/cancelStatus/{id}', [BookController::class, 'cancelVerifyBook'])->name('pg-cancelVerified-status');
    Route::delete('/rejectBook/{requestedBook}', [BookController::class, 'PCrefuseBookRequest'])->name('pg-books.refuse-status');
});

// Library Routes
Route::prefix('librarian')->middleware(['auth', 'librarian', 'cache'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'librarianIndex'])->name('librarian.dashboard');
    Route::get('/bookEvaluation', [BookController::class, 'librarianBookEvaluation'])->name('librarian.book-evaluation');
    Route::get('/Reports', [CollectionProfileController::class, 'index'])->name('lib-Reports');
    Route::get('/collectionProfile', [BookController::class, 'librarianReport'])->name('lib-reports');
    Route::get('/showBooks/{book}', [BookController::class, 'show'])->name('lib-books.show');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('lib.books.update');
    Route::get('/books/{book}/edit', [BookController::class, 'libEdit'])->name('lib-books.edit');
    Route::put('/books/{book}', [BookController::class, 'libUpdate'])->name('lib-books.update');
    Route::put('/cancelStatus/{id}', [BookController::class, 'cancelGrant'])->name('lib-books.cancel-status');
    Route::get('/approvedBooks', [BookController::class, 'librarianApprovedBooks'])->name('librarian.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('lib.pendingBooks');
    Route::post('/approved-bookss/{id}', [BookController::class, 'autoApprovedBook'])->name('lib-approve.book');
    Route::get('/bookList/{param}', [BookController::class, 'listBooksApproval'])->name('lib-books-list');
    Route::put('/updateStatus/{id}', [BookController::class, 'approveBook'])->name('lib-books.approve-status');
    Route::delete('/rejectBook/{requestedBook}', [BookController::class, 'libRefuseBookRequest'])->name('lib-books.refuse-status');
    Route::post('/export-booksNoted', [BookController::class, 'exportBooks'])->name('export-Books');

});

// Faculty Routes
Route::prefix('faculty')->middleware(['auth', 'faculty', 'cache'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'facultyIndex'])->name('faculty.dashboard');
    Route::get('/bookEvaluation', [BookController::class, 'facultyBookEvaluation'])->name('faculty.bookEvaluation');
    Route::get('/archivedBooks', [BookController::class, 'archivedBooks'])->name('fac.archivedBooks');
    Route::get('/cancelHideBook{id}', [BookController::class, 'RefuseHideRequest'])->name('fac.RefuseHideRequest');
    Route::get('/showBooksss/{book}', [BookController::class, 'show'])->name('fac-books.show');
    Route::put('/books/{id}', [BookController::class, 'updateProgramHideRequest'])->name('fac.books.updateProgramHideRequest');
    Route::post('/select-book/{id}', [BookController::class, 'selectBook'])->name('fac-select.book');
    Route::put('/cancelStatus/{id}', [BookController::class, 'cancelBook'])->name('fac-books.cancel-status');
    Route::get('/approvedBooks', [BookController::class, 'approvedBooks'])->name('fac.approvedBooks');
    Route::get('/pendingBooks', [BookController::class, 'pendingBooks'])->name('fac.pendingBooks');
    Route::delete('/books/{requestedBook}', [BookController::class, 'cancelSelectedBook'])->name('fac.cancelSelectedBook');
    Route::get('/activityLogs', [ActivityLog::class, 'index'])->name('activityLogs');

    

});

// Error message
Route::view('error', 'error/index')->name('error');
