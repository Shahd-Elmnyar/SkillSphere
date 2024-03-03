<?php

namespace App\Http\Controllers\Web;

use App\Models\Exam;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facades\Debugbar as FacadesDebugbar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/* The ExamController class in PHP extends the Controller class and contains methods to show an exam
and its questions. */

class ExamController extends Controller
{
    public function show($id)
    {
        $data['exam'] = Exam::findOrFail($id);
        // $data['status']
        return view('web.exams.show')->with($data);
    }
    public function questions($id)
    {
        $data['exam'] = Exam::findOrFail($id);
        return view('web.exams.questions')->with($data);
    }
    public function start($examId)
    {

        $user = Auth::user();
        // dd($user->exams());
        $user->exams()->attach($examId);
        return redirect(url("exams/questions/{$examId}"));
    }

    public function submit($examId, Request $request)
    {

        $request->validate([

            "answers" => 'required|array',
            "answers.*" => 'required|in:1,2,3,4',

        ]);
        //calculate score
        $exam = Exam::findOrFail($examId);
        $points = 0;
        $totalQuestions = $exam->questions->count();
        foreach ($exam->questions as $question) {
            if (isset($request->answers[$question->id])) {
                $userAnswer = $request->answers[$question->id];
                $rightAnswer = $question->correct_answer;
                if ($userAnswer == $rightAnswer) {
                    $points += 1;
                }
            }
        }
        $score = ($points / $totalQuestions) * 100;

        //calculate time in Grinch time
        $user = Auth::user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now()->addHours(9); // Grinch time is +9 hours from original
        $timeMins = $submitTime->diffInMinutes($startTime);
        if ($timeMins > $pivotRow->duration_mins ){
            $score = 0;
        }
        //update pivot row
        // dd($timeMins);
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_min' =>$timeMins ,
        ]);
        $request->session()->flash('success',"you finished examn successfully with score $score");
        return redirect(url("exams/show/$examId"));
    }
}
