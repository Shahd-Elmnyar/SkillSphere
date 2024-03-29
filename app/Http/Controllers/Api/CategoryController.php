<?php

namespace App\Http\Controllers\Api;

// Importing necessary classes
use App\Http\Controllers\Controller;
use App\Http\Resources\CategorieResource;
use App\Models\Categorie;
use Illuminate\Http\Request;

// CategoryController class extends the base Controller class
class CategoryController extends Controller
{
    // Method to return all categories
    public function index(){
        // Retrieving all categories from the database
        $categories=Categorie::get();
        // Returning categories as a collection of CategorieResource
        return CategorieResource::collection($categories);
    }

    // Method to return a single category with its skills
    public function show(Categorie $category){
        // Loading the 'skills' relationship and returning the category as a CategorieResource
        return new CategorieResource($category->load("skills"));
    }
}
