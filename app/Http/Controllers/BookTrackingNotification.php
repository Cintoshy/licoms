<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\User;
use App\Models\RequestedBooks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Notifications\BookApprovalNotification;
use App\Notifications\BookSelectNotification;

class BookTrackingNotification extends Controller
{

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function showApprovedNotif(Request $request, $approvedBookId, $notificationId)
    {
        try {
            // Find the approved book by its ID
            $approvedBook = RequestedBooks::findOrFail($approvedBookId);
    
            // Find the notification by its ID
            $notification = Auth::user()->notifications()->findOrFail($notificationId);
    
            
            if ($notification->unread()) {
                $notification->markAsRead();
            }
    
            // Fetch other necessary data (e.g., courses)
            $courses = Course::all();
    
            // Load the view with the relevant data, including the approvedBook
            return view('others.bookTrackingNotif.viewApprovedBook', compact('courses', 'approvedBook'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $courses = Course::all();
            // Book or Notification not found, redirect to an error view
            return view('others.errorView',  ['message' => 'Requested book or notification not found.'], compact('courses'));
        }
    }

    public function showGrantedNotif(Request $request,  $grantedBookId, $notificationId)
    {   

    try {
        $grantedBook = RequestedBooks::findOrFail($grantedBookId);

        // Find the notification by its ID
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        
        if ($notification->unread()) {
            $notification->markAsRead();
        }

        // Fetch other necessary data (e.g., courses)
        $courses = Course::all();

        // Load the view with the relevant data, including the approvedBook
        return view('others.bookTrackingNotif.viewGrantedBook', compact('courses', 'grantedBook'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        $courses = Course::all();
        // Book or Notification not found, redirect to an error view
        return view('others.errorView',  ['message' => 'Requested book or notification not found.'], compact('courses'));
    }
    }
    public function showSelectedNotif(Request $request,  $selectedBookId, $notificationId)
    {   
        try {
        $selectedBook = RequestedBooks::findOrFail($selectedBookId);

        // Find the notification by its ID
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        
        if ($notification->unread()) {
            $notification->markAsRead();
        }

        // Fetch other necessary data (e.g., courses)
        $courses = Course::all();

        // Load the view with the relevant data, including the approvedBook
        return view('others.bookTrackingNotif.viewSelectedBook', compact('courses', 'selectedBook'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $courses = Course::all();
            // Book or Notification not found, redirect to an error view
            return view('others.errorView',  ['message' => 'Requested book or notification not found.'], compact('courses'));
        }
    }

    public function showRejectedNotif(Request $request, $rejectedBookId, $notificationId)
    {
        try {
            $rejectedBook = RequestedBooks::findOrFail($rejectedBookId);
    
            $notification = Auth::user()->notifications()->findOrFail($notificationId); 
            
            if ($notification->unread()) {
                $notification->markAsRead();
            }
    
            $courses = Course::all();
    
            return view('others.bookTrackingNotif.viewRejectedBook', compact('courses', 'rejectedBook'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $courses = Course::all();
            // Book or Notification not found, redirect to an error view
            return view('others.errorView',  ['message' => 'Requested book or notification not found.'], compact('courses'));
        }
    }
}
