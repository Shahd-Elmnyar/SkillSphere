<?php

// Define the namespace for the HomeController within the admin directory
namespace App\Http\Controllers\admin;

// Import the base Controller class and the Request class
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Role;

use Illuminate\Http\Request;

// HomeController class extends the base Controller class
class HomeController extends Controller
{
    // Method to return the admin home view
    public function index()
    {
        // Get the currently authenticated user (assuming you're using the default Laravel authentication)
        $admin = Auth::user();

        // Pass the authenticated user's name and role to the view
        return view('admin.home.index', [
            'adminName' => $admin->name,
            'adminRole' => $admin->role->name // Assuming a relationship between users and roles exists
        ]);
    }
}
