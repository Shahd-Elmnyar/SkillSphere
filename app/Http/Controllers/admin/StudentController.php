<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $studentRole = Role::where('name','Student')->first();
        $data['students']= User::where('role_id',$studentRole->id)
            ->orderBy('id','DESC')
            ->paginate(10);
        return view('admin.students.index')->with($data);
    }

    //show scores

    public function showScores($id){
        $student = User::findOrFail($id);
        if($student->role->name !== 'student'){
            return back();
        }
        $data['students']= $student;
        $data['exams']=$student->exams;
        return view('admin.students.show-scores')->with($data);

    }

    //open exam

    public function openExam($studentId,$examId){
        $student = User::findOrFail($studentId);
        if($student->role->name !== 'student'){
            return back();
        }
        $student->exams()->updateExistingPivot($examId,[
            'status'=>'opened',
        ]);
        return back();
    }

        //close exam

        public function closeExam($studentId,$examId){
            $student = User::findOrFail($studentId);
            if($student->role->name !== 'student'){
                return back();
            }
            $student->exams()->updateExistingPivot($examId,[
                'status'=>'closed',
            ]);
            return back();
        }

}
