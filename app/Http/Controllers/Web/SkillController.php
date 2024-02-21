<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id){
        $data['skill'] = Skill::findOrFail($id);
        $data['all_skills']= Skill::select('id','name')->get();
        $data['exams']= $data['skill']->exams();
        // dd($data['exams']);
        return view('web.skills.show')->with($data);
    }
}
