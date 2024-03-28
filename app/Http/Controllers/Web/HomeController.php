<?php

// Define the namespace for the HomeController
namespace App\Http\Controllers\Web;

// Import necessary classes
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie;

// HomeController class extends the base Controller class
class HomeController extends Controller
{
    // Method to return the home view
    public function index (){
        // Return the view for the home page
        return view('web.home.index');
    }
}
