<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index(){
        return view('pages/home');
    }
    public function news(){
        return view('pages/news');
    }
}
