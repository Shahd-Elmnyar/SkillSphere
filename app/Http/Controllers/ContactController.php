<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $data['setting']=Setting::select('email','phone')->first();
        return view('web.contact.index')->with($data);
    }
}
