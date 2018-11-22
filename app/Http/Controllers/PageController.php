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
        $toDate = '2018-11-16';
        $fromDate = '2018-11-04';
        $companies = Company::paginate(10);
        $networks = Network::paginate(10);
        return view('pages/home',compact('companies','networks','toDate','fromDate'));
    }


    public function news(){
        return view('pages/news');
    }

    public function show($company){
        $company = Company::find($company);
        $networks = Network::all();
        $toDate = '2018-11-16';
        $fromDate = '2018-11-04';
        // return $company;
        return view('pages/show', compact('company','networks','toDate','fromDate'));
    }

    public function display(Request $request) {
        $fromDate = $request->from;
        $toDate = $request->to;
        $companies = Company::all();
        $networks = Network::all();
        return view('pages/table', compact('companies', 'networks','toDate','fromDate'));
    }
}
