<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Retrieves and displays a list of students
    public function index(){
        // Fetch the role ID for students
        $studentRole = Role::where('name','Student')->first();
        // Retrieve all users with the student role, ordered by their ID in descending order, and paginate the results
        $data['students']= User::where('role_id',$studentRole->id)
            ->orderBy('id','DESC')
            ->paginate(10);
        // Return the view with the students data
        return view('admin.students.index')->with($data);
    }

    // Displays the scores for a specific student
    public function showScores($id){
        // Find the student by ID or fail
        $student = User::findOrFail($id);
        // Check if the user's role is not 'student', return back if true
        if($student->role->name !== 'student'){
            return back();
        }
        // Prepare the data for the view
        $data['students']= $student;
        $data['exams']=$student->exams;
        // Return the view with the data
        return view('admin.students.show-scores')->with($data);

    }

    // Opens an exam for a student
    public function openExam($studentId,$examId){
        // Find the student by ID or fail
        $student = User::findOrFail($studentId);
        // Check if the user's role is not 'student', return back if true
        if($student->role->name !== 'student'){
            return back();
        }
        // Update the pivot table to set the exam status to 'opened'
        $student->exams()->updateExistingPivot($examId,[
            'status'=>'opened',
        ]);
        // Return back
        return back();
    }

    // Closes an exam for a student
    public function closeExam($studentId,$examId){
        // Find the student by ID or fail
        $student = User::findOrFail($studentId);
        // Check if the user's role is not 'student', return back if true
        if($student->role->name !== 'student'){
            return back();
        }
        // Update the pivot table to set the exam status to 'closed'
        $student->exams()->updateExistingPivot($examId,[
            'status'=>'closed',
        ]);
        // Return back
        return back();
    }

}
