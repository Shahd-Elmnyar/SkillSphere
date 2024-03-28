<?php

// Define the namespace for the HomeController within the admin directory
namespace App\Http\Controllers\admin;

// Import the base Controller class and the Request class
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// HomeController class extends the base Controller class
class HomeController extends Controller
{
    // Method to return the admin home view
    public function index(){
        // Return the view for the admin home page
        return view('admin.home.index');
    }
}
