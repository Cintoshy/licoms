<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\RequestedBooks;

class BookApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bookTracking;

    public function __construct(RequestedBooks $bookTracking)
    {
        $this->bookTracking = $bookTracking;
    }


    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('mail')
            ->subject('Book Approval Mail');
    }
}
