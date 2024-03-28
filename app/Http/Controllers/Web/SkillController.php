<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

// SkillController handles web requests related to skills.
class SkillController extends Controller
{
    // Show details for a specific skill by its ID.
    public function show($id){
        // Retrieve the skill by ID or throw a 404 error if not found.
        $data['skill'] = Skill::findOrFail($id);
        // Select all skills that are marked as active.
        $data['all_skills']= Skill::select('id','name')->active()->get();
        // Get all active exams associated with this skill.
        $data['exams']= $data['skill']->exams()->active();
        // Uncomment the line below to debug and view the exams data structure.
        // dd($data['exams']);
        // Return the skill view with the data array.
        return view('web.skills.show')->with($data);
    }
}
