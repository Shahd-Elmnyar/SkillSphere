<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Skill;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// SkillController handles all operations related to skills management in the admin panel
class SkillController extends Controller
{
    // Display a listing of the skills with pagination.
    public function index()
    {
        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10); // Fetch skills in descending order of their IDs
        $data['categories'] = Categorie::select('id', 'name')->get(); // Fetch all categories
        return view('admin/skills/index')->with($data); // Return the view with the fetched data
    }

    // Store a newly created skill in the database.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img'=>'required|image|max:2024', // Image must not exceed 2MB
            'category_id' => 'required|exists:categories,id', // Ensure the category exists
        ]);
        // Create the skill with the validated data
        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
                'categorie_id' => $request->categorie_id,
            ]),
        ]);
        session()->flash('msg', 'row added successfully'); // Flash a success message to the session
        return back(); // Redirect back to the previous page
    }

    // Delete a specific skill from the database.
    public function delete(Skill $skill, Request $request)
    {
        try {
            $isDeleted = $skill->delete(); // Attempt to delete the skill
            $msg = 'row deleted successfully'; // Success message
        } catch (Exception $e) {
            $msg = 'can not delete this skill'; // Failure message
        }
        session()->flash('msg', $msg); // Flash a message to the session
        return back(); // Redirect back to the previous page
    }

    // Update the specified skill in the database.
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'id' => 'required|exists:skills,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
        // Find the skill by ID and update its details
        Skill::findOrFail($request->id)->update([
            'name' => json_encode(([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])),
        ]);
        session()->flash('msg', 'row updated successfully'); // Flash a success message to the session
        return back(); // Redirect back to the previous page
    }

    // Toggle the active status of a skill.
    public function toggle(Skill $skill)
    {
        $skill->update([
            'active' => !$skill->active, // Toggle the active status
        ]);
        return back(); // Redirect back to the previous page
    }
}
