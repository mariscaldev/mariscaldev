<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreMiController extends Controller
{
    public function index() {
        return view('main.sobre-mi');
    }
}
