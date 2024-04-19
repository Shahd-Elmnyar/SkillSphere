<?php

// Define the namespace for the HomeController
namespace App\Http\Controllers\Web;

// Import necessary classes
use App\Models\Exam;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// HomeController class extends the base Controller class
class HomeController extends Controller
{
    // Method to return the home view
    public function index (){
        $data['PopularExams']= Exam::withCount('users')
        ->orderByDesc('users_count')
        ->take(5) // Limit to top 5 popular exams
        ->get();
        // Return the view for the home page
        return view('web.home.index')->with($data);
    }
}
