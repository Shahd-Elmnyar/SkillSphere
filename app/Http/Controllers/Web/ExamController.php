<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function show($id){
        $data['exam']=Exam::findOrFail($id);
        return view('web.exams.show')->with($data);
    }
    public function questions($id){
        $data['exam']=Exam::findOrFail($id);

        return view('web.exams.questions')->with($data);
    }
}
