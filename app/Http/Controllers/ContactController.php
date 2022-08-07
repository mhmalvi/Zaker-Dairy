<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'subject' => 'required',
            'message' => 'required|min:6'
        ]);

        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        $subject = $request->subject;
        $message = $request->message;

        $data = [
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'subject' => $subject,
            'body' => $message
        ];
 

         Mail::send('mail.contactMail', $data, function ($messages) use ($data) {

            $messages->to('zakerdairy@gmail.com');
            $messages->cc($data['email'], $data['name']);
            $messages->subject($data['subject']);
        });
        
      return back()->with('success','Message has been Sent');
        
        
        
       
    }
}
