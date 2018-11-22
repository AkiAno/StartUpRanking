<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Network;

class PageController extends Controller
{
    //
    public function index(){
        // return 'im here';
        //displaying companies
        $toDate = '2018-11-22';
        $fromDate = '2017-10-01';
        $companies = Company::all();
        $networks = Network::all();
        return view('pages/home',compact('companies','networks','toDate','fromDate'));
    }


    public function news(){
        return view('pages/news');
    }


    public function show($company){
        $company = Company::find($company);
        $networks = Network::all();
        $toDate = '2018-11-22';
        $fromDate = '2017-10-01';
        // return $company;
        return view('pages/show', compact('company','networks','toDate','fromDate'));
    }
}
