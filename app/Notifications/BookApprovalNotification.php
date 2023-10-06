<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\RequestedBooks;
use App\Models\User;

class BookApprovalNotification extends Notification
{   
        public $bookTracking;


        public function __construct(RequestedBooks $bookTracking)
        {   
            $this->bookTracking = $bookTracking;

        }

        public function toMail($notifiable)
        {
            return (new MailMessage)
                ->greeting('Hello, LICOMS User')
                ->line('The book "' . $this->bookTracking->book->title . '" request for "' . $this->bookTracking->course_id . '" course subject has been approved by ' .$this->bookTracking->librarian->first_name . ' ' . $this->bookTracking->librarian->last_name . '')
                // ->lineIf($this->amount > 0, "Amount paid: {$this->amount}")
                ->action('View Book', url('licoms'))
                ->line('Thank you for participating in Book Evaulation!');
        }

        public function toDatabase($notifiable)
        {
            return new DatabaseMessage([
                'message' => 'The book "' . $this->bookTracking->book->title . '" request for "' . $this->bookTracking->course_id . '" course subject has been approved by ' .$this->bookTracking->librarian->first_name . ' ' . $this->bookTracking->librarian->last_name . '',
                'icon' => 'fa-solid fa-circle-check fa-lg text-white',
                'action_url' => route('all.approvedBooks.show', ['approvedBook' => $this->bookTracking->id, 'notificationId' => $this->id]),
                'color_icon' => 'icon-circle bg-gradient-success',
                'type' => 'book_approval',
                'program' => $this->bookTracking->program_name,
            ]);
        }
        
        public function via($notifiable)
        {
            return ['database'];
        }
}

