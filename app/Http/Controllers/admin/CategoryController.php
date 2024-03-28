<?php

namespace App\Http\Controllers\admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class CategoryController extends Controller
{
    // Function to display categories in descending order of their IDs
    public function index()
    {
        $data['categories'] = Categorie::orderBy('id', 'DESC')->paginate(10);
        return view('admin/categories/index')->with($data);
    }

    // Function to store a new category in the database
    public function store(Request $request)
    {
        // Validate the request parameters
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
        // Create a new category with the validated data
        Categorie::create([
            'name' => json_encode(([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])),
        ]);
        // Flash a success message to the session
        session()->flash('msg', 'row added successfully');
        return back();
    }

    // Function to delete a category
    public function delete(Categorie $categorie, Request $request)
    {
        try {
            // Attempt to delete the category
            $isDeleted = $categorie->delete();
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            // Catch any exceptions and set an error message
            $msg = 'can not delete this category';
        }
        // Flash a message to the session
        session()->flash('msg', $msg);
        return back();
    }

    // Function to update a category's details
    public function update(Request $request)
    {
        // Validate the request parameters
        $request->validate([
            'id' => 'required|exists:categories,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
        // Find the category by ID and update its details
        Categorie::findOrFail($request->id)->update([
            'name' => json_encode(([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])),
        ]);
        // Flash a success message to the session
        session()->flash('msg', 'row updated successfully');
        return back();
    }

    // Function to toggle the active status of a category
    public function toggle(Categorie $categorie)
    {
        // Update the category's active status to its opposite value
        $categorie->update([
            'active' => !$categorie->active,
        ]);
        return back();
    }
}
