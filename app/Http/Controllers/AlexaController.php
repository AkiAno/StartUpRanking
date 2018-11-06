<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\APIs\UrlInfo;

class AlexaController extends Controller
{
    //MS

    public function index() {
        $urlInfo = new UrlInfo(env('ALEXA_ACCESS_KEY_ID'),env('ALEXA_SECRET_ACCESS_KEY'), 'tesla.com');
        $urlInfo->getUrlInfo(); 


    }
}