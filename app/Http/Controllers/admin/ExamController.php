<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function index()
    {
        $data['exams'] = Exam::select('id','name','skill_id','img','questions_number','active')->orderBy('id', 'DESC')->paginate(10);
        return view('admin/exams/index')->with($data);
    }
    public function show(Exam $exam)
    {
        $data['exams'] = $exam;
        return view('admin/exams/show')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
        Exam::create([
            'name' => json_encode(([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])),
        ]);
        $request->session()->flash('msg', 'row added successfully');
        return back();
    }
    public function delete(Exam $exam, Request $request)
    {
        try {
            $isDeleted = $exam->delete();
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            $msg = 'can not delete this exam';
        }
        $request->session()->flash('msg', $msg);
        return back();
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:exams,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
        //  dd($request->id);
        Exam::findOrFail($request->id)->update([
            'name' => json_encode(([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])),
        ]);
        $request->session()->flash('msg', 'row updated successfully');
        return back();
    }
    public function toggle(Exam $exam)
    {
        $exam->update([
            'active' => !$exam->active,
        ]);
        return back();
    }
}
