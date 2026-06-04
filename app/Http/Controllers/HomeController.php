<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Construtor
    public function __construct() {
        
    }

    // Página Inincial
    public function home(){
        return view('pages.landing.home');
    }
}
