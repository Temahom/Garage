<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\SendMail;
class MailSend extends Controller
{
    public function mailsend()
    {
        $details = [
            'title' => 'Dev-MaLin',
            'body' => 'It s very funs'
        ];

        \Mail::to('fatoubibi96@gmail.com')->send(new SendMail($details));
        return view('emails.thanks');
    }
}