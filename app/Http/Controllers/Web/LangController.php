<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// LangController extends the base Controller class
class LangController extends Controller
{
    // Method to set the application language
    public function set($lang, Request $request){
        // Define the list of accepted languages
        $acceptedLangs = ['en', 'ar'];
        // Check if the requested language is in the list of accepted languages
        if (!in_array($lang, $acceptedLangs)){
            // Default to English if the requested language is not accepted
            $lang = 'en';
        }
        // Store the selected language in the session
        $request->session()->put('lang', $lang);
        // Redirect back to the previous page
        return back();
    }
}
