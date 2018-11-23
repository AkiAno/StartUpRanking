<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\APIs\UrlInfo;

class YoutubeController extends Controller {

    public function index()
    { 
        $output = null;
         exec('node ../youtubeScraping.js', $output);
        // return $output;
        return view('pages/youtube', compact('output'));
    }
}
