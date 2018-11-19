<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Metric_description;
use App\Account;
use DB;

class RankingsController extends Controller
{
   public function index(){
       $description = Metric_description::find(4);

       // $today = date('Y-m-d 0:0:0', time());
       $today = '2018-11-16';
       // WE WANT ONE MONTH / ONE WEEK / ONE XY..
       $past = '2018-11-12 00:00:00';

  

       $accounts = Account::select([
               '*',
               DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
               DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
           ])->where('network_id', $description->network_id)
          
           // ->orderByRaw('(today_value - past_value) desc')
           // -> this will give you Order by TOTAL CHANGE
          
           ->orderByRaw('((today_value / past_value) - 1) desc')
           // -> this will give you order by % CHANGE

           ->limit(10)->get();
      

       //foreach($accounts as $acc){
       //    print_r([
       //        'company' => $acc->handle,
       //        'diff' => $acc->today_value - $acc->past_value
       //    ]);
       

    //return $accounts;

    return view('rankings/home', compact('accounts','today','past','description'));

       } 

    
}