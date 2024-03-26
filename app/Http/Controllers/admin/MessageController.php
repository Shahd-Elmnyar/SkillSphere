<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactResponsiveMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{

    //index

    public function index (){
        $data['messages']=Message::orderBy('id', 'asc')->paginate(10);
        return view('admin.messages.index')->with($data);
    }

    //show

    public function show(Message $message){
        $data['messages']=$message;
        return view('admin.messages.show')->with($data);
    }

    //response

    public function response(Message $message, Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'body' =>'required|string',
        ]);
        $receiverName = $message->name;
        $receiverMail = $message->email;
        Mail::to($receiverMail)->send(
            new ContactResponsiveMail($receiverName,$request->title,$request->body
        ));
        return redirect(url('dashboard/messages'));
    }
}
