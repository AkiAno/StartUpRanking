<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\APIs\UrlInfo;

class AlexaController extends Controller
{
    //MS



    public function index() {
        
        // Get Alexa info for tesla.com
        $urlInfo = new UrlInfo(env('ALEXA_ACCESS_KEY_ID'),env('ALEXA_SECRET_ACCESS_KEY'), 'tesla.com');
        $metricvalues=$urlInfo->getUrlInfo();
        $metricvalues['company_name'] = 'tesla.com';
        
        // Fetch Alexa network id from db
        
        
        dd($metricvalues); 

    }
}