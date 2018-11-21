<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\APIs\UrlInfo;

class RedditController extends Controller
{
    public function index(Request $request) {
        $arr = array(
            'Reddit: Tesla' => 'https://www.reddit.com/r/teslamotors/',
            'Reddit: Amazon' => 'https://www.reddit.com/r/amazon/',
            'Reddit: SpaceX' => 'https://www.reddit.com/r/spacex/',
            'Reddit: Binance' => 'https://www.reddit.com/r/binance/',
            'Reddit: Bitcoin' => 'https://pay.reddit.com/r/Bitcoin',
            'Reddit: Coinbase' => 'https://www.reddit.com/r/CoinBase/',
        
        );

        
        $headline_urlsource_name = $request->input("headline_urlsource_name", null);
        $checked_new = $request->input("checked_new", null);
        $checked_top = $request->input("checked_top", null);

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
        
        $string_output = '<table>';
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
        
        
            $string_output .= '<div>';
            $string_output .= '<h3 style="display:inline;">' . $post_title . '</h3> |';
            $string_output .= '<a href="' . $post_url . '" target="_blank">' . $post_url . '</a><br>';
            $string_output .= '</div>';
        
        
            $x++;
        
        }
        
        $string_output .= '</td></tr>';
        $string_output .= '</table>';
        
        $response = $string_output;

    }

        return view('pages/reddit', ['arr' => $arr, 'headline_urlsource_name' => $headline_urlsource_name, 'checked_new' => $checked_new, 'checked_top' => $checked_top, 'response'=> $response]);
    }

}