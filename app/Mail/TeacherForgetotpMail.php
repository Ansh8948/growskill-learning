<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class TeacherForgetotpMail extends Mailable
{
    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Teacher Password Reset OTP')
            ->view('emails.teacher-forget-otp');
    }
}