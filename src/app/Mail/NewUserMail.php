<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    public $subjectTitle;


    public function __construct($form, $subjectTitle)
    {
        $this->subjectTitle = $subjectTitle;
        $this->form = (object) $form;
    }

    public function build()
    {
        return $this->subject($this->subjectTitle)
            ->view('mail.new_account', ['data' => $this->form]);
    }
}
