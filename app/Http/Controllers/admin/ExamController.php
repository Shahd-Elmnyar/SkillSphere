<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class ExamController extends Controller
{


                            //exams

    public function index()
    {
        $data['exams'] = Exam::select('id','name','skill_id','img','questions_number','active')->orderBy('id', 'DESC')->paginate(10);
        return view('admin/exams/index')->with($data);
    }

    //show exam

    public function show(Exam $exam)
    {
        $data['exams'] = $exam;
        return view('admin/exams/show')->with($data);
    }


    //create exam

    public function create (){
        $data['skills'] = Skill::select('id', 'name')->get();
        return view('admin.exams.create')->with($data);
    }

    //store exam

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'img'=>'required|image|max:2024',
            'skill_id' => 'required|exists:skills,id',
            'questions_no'=>'required|integer|min:1',
            'difficulty'=>'required|integer|min:1|max:5',
            'duration_mins'=>'required|integer|min:1',
        ]);
        $path = Storage::putFile('exams',$request->file('img'));
        $exam = Exam::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'description' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'img'=>$path,
            'skill_id' => $request->skill_id,
            'questions_number' => $request->questions_no,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
            'active'=>0,
        ]);
        session()->flash('prev',"exam/$exam->id");
        return redirect(url("/dashboard/exams/create-questions/{$exam->id}"));
    }

    //delete exam

    public function delete(Exam $exam, Request $request)
    {
        try {
            $isDeleted = $exam->delete();
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            $msg = 'can not delete this exam';
        }
        session()->flash('msg', $msg);
        return back();
    }

    //edit exam

    public function edit(Exam $exam){
        $data['skills'] = Skill::select('id', 'name')->get();
        $data['exams'] = $exam;
        return view('admin.exams.edit')->with($data);
    }

    //update exam

    public function update( Exam $exam ,Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'img'=>'nullable|image|max:2024',
            'skill_id' => 'required|exists:skills,id',
            'difficulty'=>'required|integer|min:1|max:5',
            'duration_mins'=>'required|integer|min:1',
        ]);
        $path =$exam->img;
        if ($request->hasFile('img')){
            Storage::delete($path);
            $path = Storage::putFile("exams", $request->file('img'));
        }
        $exam->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'description' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'img'=>$path,
            'skill_id' => $request->skill_id,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
        ]);
        session()->flash('msg', 'row updated successfully');
        return redirect(url("/dashboard/exams/"));
    }

    //toggle active status
    public function toggle(Exam $exam)
    {
        $exam->update([
            'active' => !$exam->active,
        ]);
        return back();
    }



                            //Questions



    //show questions

    public function showQuestions(Exam $exam)
    {
        $data['exams'] = $exam;
        return view('admin/exams/showQuestions')->with($data);
    }

    //create Question

    public function createQuestions(Exam $exam){
        if(session('prev')!=="exam/$exam->id" and session('current')!== "exam/$exam->id"){
            return redirect(url('/dashboard/exams'));
        }
        $data['exam_id']= $exam->id;
        $data['question_no']= $exam->questions_number;
        return view('admin/exams/create-questions')->with($data);
    }

    //store Question

    public function storeQuestions(Exam $exam , Request $request){
        session()->flash('current',"exam/$exam->id");
        $request->validate([
            'titles'=>'required|array',
            'title.*'=>'required|string|max:500',
            'right_answer'=>'required|array',
            'right_answer.*'=>'required|in:1,2,3,4',
            'option_1s.*'=>'required|string|max:255',
            'option_1s'=>'required|array',
            'option_2s'=>'required|array',
            'option_2s.*'=>'required|string|max:255',
            'option_3s'=>'required|array',
            'option_3s.*'=>'required|string|max:255',
            'option_4s'=>'required|array',
            'option_4s.*'=>'required|string|max:255',
            'titles'=>'required|array',
        ]);
        for ($i = 0; $i <$exam->question_no; $i++){
            Question::create([
                'exam_id'=>$exam->id,
                'title'=>$exam->titles[$i],
                'option_1'=>$exam->option_1s[$i],
                'option_2'=>$exam->option_2s[$i],
                'option_3'=>$exam->option_3s[$i],
                'option_4'=>$exam->option_4s[$i],
                'correct_answer'=>$exam->right_answer[$i],
            ]);
        }
        $exam->update([
            'active' => !$exam->active,
        ]);
        return redirect(url('dashboard/exams'));
    }
}
