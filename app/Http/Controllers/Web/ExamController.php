<?php

namespace App\Http\Controllers\Web;

use App\Models\Exam;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facades\Debugbar as FacadesDebugbar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ExamController extends Controller
{
    // Show exam details by ID
    public function show($id)
    {
        $data['exam'] = Exam::findOrFail($id); // Find the exam or fail
        $user = Auth::user(); // Get the authenticated user
        $data['canEnterExam']=true; // Assume the user can enter the exam by default
        if ($user!==null){ // Check if user is not null
            $pivotRow=$user->exams()->where('exam_id',$id)->active()->first(); // Get the user's exam pivot row
            if ($pivotRow !== null and $pivotRow->pivot->status =='closed'){ // Check if the exam status is closed
                $data['canEnterExam']=false; // Set canEnterExam to false if exam is closed
            }
        }

        return view('web.exams.show')->with($data); // Return the exam view with data
    }

    // Show questions for a specific exam
    public function questions($examId , Request $request)
    {
        if (session('previous')!=="start/$examId"){ // Check if the previous session is not the start of the exam
            return redirect(url("exams/show/$examId")); // Redirect to the exam show page
        }
        $data['exam'] = Exam::findOrFail($examId); // Find the exam or fail
        session()->flash('previous',"questions/$examId"); // Flash the current state to session
        return view('web.exams.questions')->with($data); // Return the questions view with data
    }

    // Start an exam
    public function start($examId,Request $request)
    {
        $user = Auth::user(); // Get the authenticated user
        if(!$user->exams->contains($examId)){ // Check if the user has not started the exam
            $user->exams()->attach($examId); // Attach the exam to the user
        }else{
            $user->exams()->updateExistingPivot($examId,[ // Update the pivot table if the exam has already been started
                'status' => 'closed', // Set the exam status to closed
            ]);
        }
        session()->flash('previous',"start/$examId"); // Flash the current state to session
        return redirect(url("exams/questions/{$examId}")); // Redirect to the exam questions page
    }

    // Submit exam answers
    public function submit($examId, Request $request)
    {
        if (session('previous')!=="questions/$examId"){ // Check if the previous session is not the questions page
            return redirect(url("exams/show/$examId")); // Redirect to the exam show page
        }

        $request->validate([ // Validate the request
            "answers" => 'required|array', // Answers must be a required array
            "answers.*" => 'required|in:1,2,3,4', // Each answer must be required and one of the specified values
        ]);
        // Calculate score
        $exam = Exam::findOrFail($examId); // Find the exam or fail
        $points = 0; // Initialize points
        $totalQuestions = $exam->questions->count(); // Count the total questions
        foreach ($exam->questions as $question) { // Iterate through each question
            if (isset($request->answers[$question->id])) { // Check if the answer is set
                $userAnswer = $request->answers[$question->id]; // Get the user's answer
                $rightAnswer = $question->correct_answer; // Get the correct answer
                if ($userAnswer == $rightAnswer) { // Compare the user's answer with the correct answer
                    $points += 1; // Increment points if the answer is correct
                }
            }
        }
        $score = ($points / $totalQuestions) * 100; // Calculate the score as a percentage

        // Calculate time taken to complete the exam
        $user = Auth::user(); // Get the authenticated user
        $pivotRow = $user->exams()->where('exam_id', $examId)->active()->first(); // Get the user's exam pivot row
        $startTime = $pivotRow->pivot->created_at; // Get the start time from the pivot row
        $submitTime = Carbon::now(); // Get the current time
        $timeMins = $submitTime->diffInMinutes($startTime); // Calculate the time taken in minutes
        if ($timeMins > $pivotRow->duration_mins ){ // Check if the time taken exceeds the allowed duration
            $score = 0; // Set the score to 0 if the time limit is exceeded
        }
        // Update pivot row with the score and time taken
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_min' =>$timeMins ,
        ]);
        session()->flash('success',"you finished exam successfully with score $score %"); // Flash success message to session
        return redirect(url("exams/show/$examId")); // Redirect to the exam show page
    }
}
