<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Network;

class PageController extends Controller
{
    //
    public function index(){
        //displaying companies
        $companies = Company::all();
        $networks = Network::all();
        return view('pages/home',compact('companies','networks'));
    }


    public function news(){
        return view('pages/news');
    }


    public function show($company){
        $company = Company::find($company);
        // return $company;
        return view('pages/show', compact('company'));
    }
}
