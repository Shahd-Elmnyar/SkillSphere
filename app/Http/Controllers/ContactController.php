<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(){
        $data['setting']=Setting::select('email','phone')->first();
        return view('web.contact.index')->with($data);
    }

    //send

    public function send(Request $request){
        $Validator =Validator::make($request->all(),[
        'name'=>'required|string|max:255',
        'email'=>'required|email|max:255',
        'subject'=>'nullable|max:255|string',
        'body'=>'required|string  '
        ]);
        if($Validator->fails()){
            $errors= $Validator->errors();
            return redirect(url('contact'))->withErrors($errors);
        }
        Message::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'body'=>$request->body
        ]);
        session()->flash('success','your message sent successfully');
        return back();
    }
}
