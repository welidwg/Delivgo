<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Mail\PasswordRecovery;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function SendMail($email, $title, $name, $code)
    {
        $details = [
            "title" => $title,
            "name" => $name,
            "code" => $code
        ];
        Mail::to($email)->send(new EmailVerification($details));
        return response("Mail Sent", 200);
    }
    public function SendPasswordRecovery($email, $title, $name, $code)
    {
        $details = [
            "title" => $title,
            "name" => $name,
            "code" => $code
        ];
        Mail::to($email)->send(new PasswordRecovery($details));
        return response("Mail Sent", 200);
    }
}
