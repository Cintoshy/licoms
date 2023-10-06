<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
// use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\RequestedBooks;
use App\Models\User;


class BookGrantedNotification extends Notification
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
            'message' =>'The book "' . $this->bookTracking->book->title . '" has been verified of ' .$this->bookTracking->programChair->first_name . ' ' . $this->bookTracking->programChair->last_name . ' for "' . $this->bookTracking->course_id . '" course subject .',
            'icon' => 'fa-solid fa-address-book text-white',
            'color_icon' => 'icon-circle bg-gradient-warning',
            'action_url' => route('all.grantedBooks.show', ['grantedBook' => $this->bookTracking->id, 'notificationId' => $this->id]),
            'type' => 'book_grant',
            'program' => $this->bookTracking->program_name,
        ]);
    }

    public function via($notifiable)
    {
        return ['database'];
    }
}
