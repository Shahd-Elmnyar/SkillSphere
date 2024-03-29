<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;

class SkillController extends Controller
{
    // Method to return a single skill with its skills
    public function show(Skill $skill){
        // Loading the 'skills' relationship and returning the skill as a SkillResource
        return new SkillResource($skill->load("exams"));
    }
}
