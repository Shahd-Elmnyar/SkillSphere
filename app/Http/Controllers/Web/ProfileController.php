<?php

// Define the namespace for the ProfileController
namespace App\Http\Controllers\Web;

// Import the base Controller class and the Request class
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// ProfileController class extends the base Controller class
class ProfileController extends Controller
{
    // Method to return the profile view
    public function index(){
        // Return the view for the profile page
        return view('web.profile.index');
    }
}
