<?php

namespace App\Http\Controllers\admin;

use Log;
use Exception;
use App\Models\Exam;
use App\Models\Skill;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Events\ExamAddedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    // Method to list all exams with pagination
    public function index()
    {
        $data['exams'] = Exam::select('id', 'name', 'skill_id', 'img', 'questions_number', 'active')->orderBy('id', 'DESC')->paginate(10);
        return view('admin/exams/index')->with($data);
    }

    // Method to show a single exam details
    public function show(Exam $exam)
    {
        $data['exams'] = $exam;
        return view('admin/exams/show')->with($data);
    }

    // Method to show the form for creating a new exam
    public function create()
    {
        $data['skills'] = Skill::select('id', 'name')->get();
        return view('admin.exams.create')->with($data);
    }

    // Method to store a newly created exam in storage
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'img' => 'required|image|max:2024',
            'skill_id' => 'required|exists:skills,id',
            'questions_no' => 'required|integer|min:1',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',
        ]);

        // Retrieve the file contents from the request
        $fileContents = $request->file('img');
        // Generate a unique filename by adding the current timestamp to the original filename
        $fileName = time() . '_' . $fileContents->getClientOriginalName();
        // Construct the full file path including the directory
        $filePath = 'exams'; // Adjusted path without the duplicate 'uploads'

        // Store the file in the specified path
        $path = Storage::disk('uploads')->putFileAs($filePath, $fileContents, $fileName);
        $exam = Exam::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'description' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'img' => $path,
            'skill_id' => $request->skill_id,
            'questions_number' => $request->questions_no,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
            'active' => 0,
        ]);
        session()->flash('prev', "exam/$exam->id");
        return redirect(url("/dashboard/exams/create-questions/{$exam->id}"));
    }

    // Method to delete an exam
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

    // Method to show the form for editing an exam
    public function edit(Exam $exam)
    {
        $data['skills'] = Skill::select('id', 'name')->get();
        $data['exams'] = $exam;
        return view('admin.exams.edit')->with($data);
    }

    // Method to update an exam in storage
    public function update(Exam $exam, Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'skill_id' => 'required|exists:skills,id',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',
        ]);
        Exam::findOrFail($id)->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'description' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'skill_id' => $request->skill_id,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
        ]);
        session()->flash('msg', 'row updated successfully');
        return redirect(url("/dashboard/exams/"));
    }

    // Method to toggle the active status of an exam
    public function toggle(Exam $exam)
    {
        $exam->update([
            'active' => !$exam->active,
        ]);
        return back();
    }

    // Method to show questions of an exam
    public function showQuestions(Exam $exam)
    {
        $data['exams'] = $exam;
        return view('admin/exams/showQuestions')->with($data);
    }

    // Method to show the form for creating questions for an exam
    public function createQuestions(Exam $exam)
    {
        if (session('prev') !== "exam/$exam->id" and session('current') !== "exam/$exam->id") {
            return redirect(url('/dashboard/exams'));
        }
        $data['exam_id'] = $exam->id;
        $data['question_no'] = $exam->questions_number;
        return view('admin/exams/create-questions')->with($data);
    }

    // Method to store newly created questions for an exam
    public function storeQuestions(Exam $exam, Request $request)
{
    try {
        $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:500',
            'right_answer' => 'required|array',
            'right_answer.*' => 'required|in:1,2,3,4',
            'option_1s.*' => 'required|string|max:255',
            'option_2s.*' => 'required|string|max:255',
            'option_3s.*' => 'required|string|max:255',
            'option_4s.*' => 'required|string|max:255',
        ]);

        foreach ($request->titles as $index => $title) {
            Question::create([
                'exam_id' => $exam->id,
                'title' => $title,
                'option_1' => $request->option_1s[$index],
                'option_2' => $request->option_2s[$index],
                'option_3' => $request->option_3s[$index],
                'option_4' => $request->option_4s[$index],
                'correct_answer' => $request->right_answer[$index],
            ]);
        }

        $exam->update([
            'active' => !$exam->active,
        ]);

        event(new ExamAddedEvent);

        return redirect(url('dashboard/exams'));
    } catch (\Exception $e) {
        // Log the exception
        Log::error($e->getMessage());
        // Handle the exception as needed
        return back()->withInput()->withErrors(['error' => 'An error occurred while storing the questions.']);
    }
}

}
