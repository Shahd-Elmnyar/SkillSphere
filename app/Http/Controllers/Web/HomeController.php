<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie;

class HomeController extends Controller
{
    public function index (){ 
        return view('web.home.index');
    }
}
