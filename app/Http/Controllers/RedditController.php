<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\APIs\UrlInfo;
use Antoineaugusti\LaravelSentimentAnalysis\SentimentAnalysis;


class RedditController extends Controller
{
    public function index(Request $request) {
        $arr = array(
            'Reddit: Stock Market' => 'https://www.reddit.com/r/STOCKMARKETNEWS/',            
            'Reddit: WallStreet Bets' => 'https://www.reddit.com/r/wallstreetbets/',
            'Reddit: Bloomberg' => 'https://www.reddit.com/r/bloomberg/',
            'Reddit: Samsung' => 'https://www.reddit.com/r/baidu/',
            'Reddit: IBM' => 'https://www.reddit.com/r/IBM/',
            'Reddit: Microsoft' => 'https://www.reddit.com/r/microsoft/',
            'Reddit: Netflix' => 'https://www.reddit.com/r/netflix/',
            'Reddit: Alphabet' => 'https://www.reddit.com/r/alphabet/',
            'Reddit: Tesla' => 'https://www.reddit.com/r/teslamotors/',
            'Reddit: Amazon' => 'https://www.reddit.com/r/amazon/',
            'Reddit: SpaceX' => 'https://www.reddit.com/r/spacex/',
            'Reddit: BlueOrigin' => 'https://www.reddit.com/r/BlueOrigin/',            
            'Reddit: Uber' => 'https://www.reddit.com/r/uber/',
            'Reddit: Google' => 'https://www.reddit.com/r/google/'
        
        );

        
        $headline_urlsource_name = $request->input("headline_urlsource_name", null);
        $checked_new = $request->input("checked_new", null);
        $checked_top = $request->input("checked_top", null);
        $evaluations = [];

        $response = null;

        if (!empty($_POST)){

            if ($checked_new=="checked"){
                $headline_urlsource_name_json = $arr[$headline_urlsource_name] . 'new/.json';
                $type_category=' - New';
            } else {
                $headline_urlsource_name_json = $arr[$headline_urlsource_name] . '.json';
                $type_category=' - Top';
            }

        } else {
            $headline_urlsource_name_json='';
           
        
        }

        $response = null;
        if($headline_urlsource_name_json!==''){
       
        $data_json=file_get_contents($headline_urlsource_name_json);
        
        // //echo $data_json;
        
        $json = json_decode($data_json);
       
        
        // // echo $json->data->children[0]->kind;
        
        $string_output = '<table width=100%>';
        $string_output .= '<tr><td width=1000>';
        
        // //print_r($json->data->children);
        
        $x=1;
        
        $count_articles = count($json->data->children);
        
        foreach($json->data->children as $key=>$value){
        
            //echo $json->data->children[$key]->data->domain . '<br>';
        
            $post_domain=$json->data->children[$key]->data->domain;
            $post_score=$json->data->children[$key]->data->score;
            $post_num_comments=$json->data->children[$key]->data->num_comments;
            $post_url=$json->data->children[$key]->data->url;
            $post_title=$json->data->children[$key]->data->title;
        
            $pos_domain = strpos($post_domain,'self.');
        
            if ($pos_domain === false) {
        
            } else {
                continue; // skip the Reddit "Self" posts
            }

            //dd($post_title);
            $analysis = new SentimentAnalysis;
            //dd($analysis->isPositive($post_title));   
            
            $sentenceEvaluation = ($analysis->decision($post_title));
            
            
            array_push($evaluations, $sentenceEvaluation);
        
            $string_output .= '<div class="reddit-response">';
            $string_output .= '<h3 style="">' . $post_title . ' </h3> <span class="sentimic-analyze">'. $sentenceEvaluation.'</span>';
            $string_output .= '<a href="' . $post_url . '" target="_blank">' . $post_url . '</a><br>';
            $string_output .= '</div>';
            //dd($string_output);
        
            
            $x++;
        
        }
        
        $string_output .= '</td></tr>';
        $string_output .= '</table><br><br>';

        
        $response = $string_output;

    }


        return view('pages/reddit', ['arr' => $arr, 'headline_urlsource_name' => $headline_urlsource_name, 'checked_new' => $checked_new, 'checked_top' => $checked_top, 'response'=> $response, 'evaluations' => $evaluations]);

    }

}

// class SentimentAnalysisTest extends PHPUnit_Framework_TestCase
// {
//     public $sentiment;
//     public function setUp()
//     {
//         parent::setUp();
//         $this->sentiment = new SentimentAnalysis();
//     }
//     public function testIsPositive()
//     {
//         $this->assertEquals(true, $this->sentiment->isPositive($post_title));
//         dd($post_title);
        
//     }
// }
