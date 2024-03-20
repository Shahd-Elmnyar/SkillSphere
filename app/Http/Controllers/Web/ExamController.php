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
        $user = Auth::user();
        $data['canEnterExam']=true;
        if ($user!==null){
            $pivotRow=$user->exams()->where('exam_id',$id)->active()->first();
            if ($pivotRow !== null and $pivotRow->pivot->status =='closed'){
                $data['canEnterExam']=false;
            }
        }

        return view('web.exams.show')->with($data);
    }


    public function questions($examId , Request $request)
    {
        if (session('previous')!=="start/$examId"){
            return redirect(url("exams/show/$examId"));
        }
        $data['exam'] = Exam::findOrFail($examId);
        session()->flash('previous',"questions/$examId");
        return view('web.exams.questions')->with($data);
    }


    public function start($examId,Request $request)
    {

        $user = Auth::user();
        // dd($user->exams());
        if(!$user->exams->contains($examId)){
            $user->exams()->attach($examId);
        }else{
            $user->exams()->updateExistingPivot($examId,[
                'status' => 'closed',
            ]);
        }
        session()->flash('previous',"start/$examId");
        return redirect(url("exams/questions/{$examId}"));
    }


    public function submit($examId, Request $request)
    {
        if (session('previous')!=="questions/$examId"){
            return redirect(url("exams/show/$examId"));
        }

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
        $pivotRow = $user->exams()->where('exam_id', $examId)->active()->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();
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
        session()->flash('success',"you finished exam successfully with score $score%");
        return redirect(url("exams/show/$examId"));
    }
}
