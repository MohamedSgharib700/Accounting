<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View ;
class HomeController extends Controller
{

    
    public function index()
    {
        return view('admin.index');
    }
}
