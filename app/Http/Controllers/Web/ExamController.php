<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function show($id){
        return view('web.exams.show');
    }
    public function questions($id){
        return view('web.exams.questions');
    }
}
