<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

/* The CategoryController class in PHP extends the Controller class and contains a method to show a
specific category by its ID. */

class CategoryController extends Controller
{
    public function show($id)
    {

        $data['category'] = Categorie::findOrFail($id);
        $data['all_categories']= Categorie::select('id','name')->active()->get();
        $data['skills']= $data['category']->skills()->active()->paginate(6);
        // dd($data['skills']);
        return view('web.categories.show')->with($data);
    }
}
