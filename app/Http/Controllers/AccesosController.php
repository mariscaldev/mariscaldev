<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccesosController extends Controller
{
    public function index() {
        return view('main.accesos-directos');
    }
}
