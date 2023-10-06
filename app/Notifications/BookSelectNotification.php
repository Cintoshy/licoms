<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
// use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\RequestedBooks;
use App\Models\User;

class BookSelectNotification extends Notification
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
            'message' =>'The book "' . $this->bookTracking->book->title . '" has been selected of ' .$this->bookTracking->faculty->first_name . ' ' . $this->bookTracking->faculty->last_name . ' for "' . $this->bookTracking->course_id . '" course subject .',
            'icon' => 'fa-solid fa-bookmark text-white',
            'color_icon' => 'icon-circle bg-gradient-primary',
            'action_url' => route('all.selectedBooks.show', ['selectedBook' => $this->bookTracking->id, 'notificationId' => $this->id]),
            'type' => 'book_select',
            'program' => $this->bookTracking->program_name,
        ]);
    }

    public function via($notifiable)
    {
        return ['database'];
    }
}

