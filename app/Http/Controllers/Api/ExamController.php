<?php

namespace App\Http\Controllers\Api;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    // Method to return a single exam with its exams
    public function show(Exam $exam){
        return new ExamResource($exam);
    }

    // Method to return a exam's questions with its exams

    public function showQuestions(Exam $exam){
        // Loading the 'exams' relationship and returning the exam as a ExamResource
        return new ExamResource($exam->load("questions"));
    }
    //start exam
    public function start($examId,Request $request)
    {
        $request->user()->exams()->attach($examId);
        return response()->json([
            'message' =>'you started exam',
        ]);
    }

    // Submit exam answers

    public function submit($examId, Request $request)
    {
        $validator = Validator::make($request->all(),[ // Validate the request
            "answers" => 'required|array', // Answers must be a required array
            "answers.*" => 'required|in:1,2,3,4', // Each answer must be required and one of the specified values
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
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
        //Calculate time taken to complete the exam
        $user = $request->user(); // Get the authenticated user
        $pivotRow = $user->exams()->where('exam_id', $examId)->first(); // Get the user's exam pivot row

        if ($pivotRow) {
            $startTime = $pivotRow->pivot->created_at; // Get the start time from the pivot row
            $submitTime = Carbon::now(); // Get the current time

            $timeMins = $submitTime->diffInMinutes($startTime); // Calculate the time taken in minutes
            if ($timeMins > $pivotRow->duration_mins) { // Check if the time taken exceeds the allowed duration
                $score = 0; // Set the score to 0 if the time limit is exceeded
            }
            // Update pivot row with the score and time taken
            $user->exams()->updateExistingPivot($examId, [
                'score' => $score,
                'time_min' => $timeMins,
            ]);
        } else {
            // Handle the case where there is no pivot row found, possibly by returning an error message
            return response()->json([
                'message' => 'Exam not started or does not exist.',
            ], 404);
        }
        return response()->json([
            'message' =>"you submitted the exam successfully , your score is $score %"
        ]);
    }
}
