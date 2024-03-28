<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // Display the contact form
    public function index(){
        // Retrieve email and phone settings
        $data['setting'] = Setting::select('email', 'phone')->first();
        // Pass the settings data to the contact view
        return view('web.contact.index')->with($data);
    }

    // Process the contact form submission
    public function send(Request $request){
        // Validate the request data
        $Validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|max:255|string',
            'body' => 'required|string'
        ]);
        // Check if validation fails
        if ($Validator->fails()) {
            // Collect the validation errors
            $errors = $Validator->errors();
            // Redirect back to the contact form with errors
            return redirect(url('contact'))->withErrors($errors);
        }
        // Create a new message record in the database
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body
        ]);
        // Flash a success message to the session
        session()->flash('success', 'Your message was sent successfully');
        // Redirect back to the contact form
        return back();
    }
}
