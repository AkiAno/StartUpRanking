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
        $fromDate = '2017-11-04';
        $companies = Company::paginate(40);
        $networks = Network::all();
        return view('pages/home',compact('companies','networks','toDate','fromDate'));
    }


    public function contacts(){
        return view('pages/contacts');
    }

    public function show($company){
        $company = Company::find($company);
        $networks = Network::all();
        $toDate = '2018-11-16';
        $fromDate = '2017-11-04';
        // return $company;
        return view('pages/show', compact('company','networks','toDate','fromDate'));
    }

    public function display(Request $request) {
        $first_date = $request->from;
        $second_date = $request->to;

        $fromDate = date("Y-m-d",strtotime($first_date));
        $toDate = date("Y-m-d",strtotime($second_date));

        // $companies = Company::where('created_at','>=',date("Y-m-d",strtotime($first_date)))->where('created_at','<=',date("Y-m-d",strtotime($second_date)))->orderBy('id', 'ASC')->get();
        $companies = Company::all();
        $networks = Network::all();
        return view('pages/table', compact('companies', 'networks','toDate','fromDate'));
    }
}
