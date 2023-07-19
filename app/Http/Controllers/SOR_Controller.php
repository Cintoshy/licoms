<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SOR_Controller extends Controller
{
    public function index()
    {
        return view('admin.SOR.index');
    }
}
