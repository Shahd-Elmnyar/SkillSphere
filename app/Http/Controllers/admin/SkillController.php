<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Skill;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function index()
    {
        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10);
        $data['categories'] = Categorie::select('id', 'name')->get();
        return view('admin/skills/index')->with($data);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img'=>'required|image|max:2024',
            'category_id' => 'required|exists:categories,id',
        ]);
        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
                'categorie_id' => $request->categorie_id,
            ]),
        ]);
        session()->flash('msg', 'row added successfully');
        return back();
    }
    public function delete(Skill $skill, Request $request)
    {
        try {
            $isDeleted = $skill->delete();
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            $msg = 'can not delete this skill';
        }
        session()->flash('msg', $msg);
        return back();
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:skills,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
        //  dd($request->id);
        Skill::findOrFail($request->id)->update([
            'name' => json_encode(([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])),
        ]);
        session()->flash('msg', 'row updated successfully');
        return back();
    }
    public function toggle(Skill $skill)
    {
        $skill->update([
            'active' => !$skill->active,
        ]);
        return back();
    }
}
