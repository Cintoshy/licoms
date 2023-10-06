<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
// use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\RequestedBooks;
use App\Models\User;

class BookRejectedNotification extends Notification
{
    public $bookTracking;


    public function __construct(RequestedBooks $bookTracking)
    {   
        $this->bookTracking = $bookTracking;

    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->line('Your book request has been approved.')
    //         ->action('View Book', url('programChair/approvedBooks'));
    // }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'message' => 'The book "' . $this->bookTracking->book->title . '" has been rejected by ' .$this->bookTracking->librarian->first_name . ' ' .$this->bookTracking->librarian->last_name . ' for "' . $this->bookTracking->course_id . '" course subject. The book has been available again in the Book Evaluation Selection',
            'icon' => 'fa-solid fa-circle-exclamation fa-lg text-white',
            'color_icon' => 'icon-circle bg-gradient-danger',
            'action_url' => route('all.rejectedBooks.show', ['rejectedBook' => $this->bookTracking->id, 'notificationId' => $this->id]),
            'type' => 'book_reject',
            'program' => $this->bookTracking->program_name,
        ]);
    }

    public function via($notifiable)
    {
        return ['database'];
    }
}
