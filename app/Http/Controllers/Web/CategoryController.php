<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

// This controller handles web requests for category-related operations.
class CategoryController extends Controller
{
    // Show a specific category by its ID.
    public function show($id)
    {
        // Find the category by ID or fail with a 404 error.
        $data['category'] = Categorie::findOrFail($id);
        // Retrieve all categories that are marked as active.
        $data['all_categories'] = Categorie::select('id', 'name')->active()->get();
        // Get the active skills associated with this category and paginate them.
        $data['skills'] = $data['category']->skills()->active()->paginate(6);
        // Return the category view with the data array.
        return view('web.categories.show')->with($data);
    }
}
