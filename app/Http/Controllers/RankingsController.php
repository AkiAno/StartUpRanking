<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Metric_description;
use App\Account;
use DB;


// PAST DATE = 3.11.2018, except FB (4.11.2018)
// TODAY => LAST DATE IN DB = 16.11., or 23.11.2018 (also for FB)


class RankingsController extends Controller
{
   public function alexa_absolute_ten(){
       $description = Metric_description::find(4); // 4 = Alexa Rank

       // $today = date('Y-m-d 0:0:0', time());
       $today = '2018-11-16';
       // WE WANT ONE MONTH / ONE WEEK / ONE XY..
       $past = '2018-11-03 00:00:00';

  
        //  OLD: = Account::select
       $accounts = Account::with('company')->select([
               '*',
               DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
               DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
           ])->where('network_id', $description->network_id)
          
          ->orderByRaw('(past_value - today_value) desc')
           // -> this will give you Order by TOTAL CHANGE
          
           //->orderByRaw('((today_value / past_value) - 1) desc')
           // -> this will give you order by % CHANGE

           //->limit(10)->get();
           ->paginate(10);
           
      

       //foreach($accounts as $acc){
       //    print_r([
       //        'company' => $acc->handle,
       //        'diff' => $acc->today_value - $acc->past_value
       //    ]);
       

    //return $accounts;

    return view('rankings/a_abs', compact('accounts'));

       } 

       public function alexa_percentage_ten(){
        $description = Metric_description::find(4);
 
        // $today = date('Y-m-d 0:0:0', time());
        $today = '2018-11-16';
        // WE WANT ONE MONTH / ONE WEEK / ONE XY..
        $past = '2018-11-03 00:00:00';
 
   
 
        $accounts = Account::with('company')->select([
                '*',
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
            ])->where('network_id', $description->network_id)
           
            // ->orderByRaw('(today_value - past_value) desc')
            // -> this will give you Order by TOTAL CHANGE
           
            ->orderByRaw('((past_value / today_value) - 1) desc')
            // -> this will give you order by % CHANGE
 
            //->limit(10)->get();
            ->paginate(10);
       
 
        //foreach($accounts as $acc){
        //    print_r([
        //        'company' => $acc->handle,
        //        'diff' => $acc->today_value - $acc->past_value
        //    ]);
        
 
     //return $accounts;
 
     return view('rankings/a_pct', compact('accounts'));
 
        } 

//////////////////////////////////////////////////////////////////


     // INSTAGRAM FOLLOWERS


     
     public function insta_absolute_ten(){
        $description = Metric_description::find(5);  // INSTAGRAM FOLLOWERS
 
        // $today = date('Y-m-d 0:0:0', time());
        $today = '2018-11-16';
        // WE WANT ONE MONTH / ONE WEEK / ONE XY..
        $past = '2018-11-03 00:00:00';
 
   
 
        $accounts = Account::with('company')->select([
                '*',
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
            ])->where('network_id', $description->network_id)
           
           ->orderByRaw('(today_value - past_value) desc')
            // -> this will give you Order by TOTAL CHANGE
           
            //->orderByRaw('((today_value / past_value) - 1) desc')
            // -> this will give you order by % CHANGE
 
            //->limit(10)->get();
            ->paginate(10);
       
 
        //foreach($accounts as $acc){
        //    print_r([
        //        'company' => $acc->handle,
        //        'diff' => $acc->today_value - $acc->past_value
        //    ]);
        
 
     //return $accounts;
 
     return view('rankings/i_abs', compact('accounts'));
 
        } 

        public function insta_percentage_ten(){
            $description = Metric_description::find(5);  // INSTAGRAM FOLLOWERS
     
            // $today = date('Y-m-d 0:0:0', time());
            $today = '2018-11-16';
            // WE WANT ONE MONTH / ONE WEEK / ONE XY..
            $past = '2018-11-03 00:00:00';
     
       
     
            $accounts = Account::with('company')->select([
                    '*',
                    DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                    DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
                ])->where('network_id', $description->network_id)
               
                ->orderByRaw('((today_value / past_value) - 1) desc')
                // -> this will give you Order by TOTAL CHANGE
               
                //->orderByRaw('((today_value / past_value) - 1) desc')
                // -> this will give you order by % CHANGE
     
                //->limit(10)->get();
                ->paginate(10);

           
     
            //foreach($accounts as $acc){
            //    print_r([
            //        'company' => $acc->handle,
            //        'diff' => $acc->today_value - $acc->past_value
            //    ]);
            
     
         //return $accounts;
     
         return view('rankings/i_pct', compact('accounts'));
     
            }


// INSTAGRAM POSTS

 


     
 public function instap_absolute_ten(){
    $description = Metric_description::find(6);  // INSTAGRAM POSTS

    // $today = date('Y-m-d 0:0:0', time());
    $today = '2018-11-16';
    // WE WANT ONE MONTH / ONE WEEK / ONE XY..
    $past = '2018-11-03 00:00:00';



    $accounts = Account::with('company')->select([
            '*',
            DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
            DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
        ])->where('network_id', $description->network_id)
       
       ->orderByRaw('(today_value - past_value) desc')
        // -> this will give you Order by TOTAL CHANGE
       
        //->orderByRaw('((today_value / past_value) - 1) desc')
        // -> this will give you order by % CHANGE

        //->limit(10)->get();
        ->paginate(10);
   

    //foreach($accounts as $acc){
    //    print_r([
    //        'company' => $acc->handle,
    //        'diff' => $acc->today_value - $acc->past_value
    //    ]);
    

 //return $accounts;

 return view('rankings/ip_abs', compact('accounts'));

    } 

    public function instap_percentage_ten(){
        $description = Metric_description::find(6);  // INSTAGRAM POSTS
 
        // $today = date('Y-m-d 0:0:0', time());
        $today = '2018-11-16';
        // WE WANT ONE MONTH / ONE WEEK / ONE XY..
        $past = '2018-11-03 00:00:00';
 
   
 
        $accounts = Account::with('company')->select([
                '*',
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
            ])->where('network_id', $description->network_id)
           
            ->orderByRaw('((today_value / past_value) - 1) desc')
            // -> this will give you Order by TOTAL CHANGE
           
            //->orderByRaw('((today_value / past_value) - 1) desc')
            // -> this will give you order by % CHANGE
 
            //->limit(10)->get();
            ->paginate(10);

       
 
        //foreach($accounts as $acc){
        //    print_r([
        //        'company' => $acc->handle,
        //        'diff' => $acc->today_value - $acc->past_value
        //    ]);
        
 
     //return $accounts;
 
     return view('rankings/ip_pct', compact('accounts'));
 
        }

/////////////////////////////////////////////////////////////////////////////////////

        // TWITTER

    
        public function twitter_absolute_ten(){
            $description = Metric_description::find(1);  // TWITTER FOLLOWERS
     
            // $today = date('Y-m-d 0:0:0', time());
            $today = '2018-11-16';
            // WE WANT ONE MONTH / ONE WEEK / ONE XY..
            $past = '2018-11-03 00:00:00';
     
       
     
            $accounts = Account::with('company')->select([
                    '*',
                    DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                    DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
                ])->where('network_id', $description->network_id)
               
               ->orderByRaw('(today_value - past_value) desc')
                // -> this will give you Order by TOTAL CHANGE
               
                //->orderByRaw('((today_value / past_value) - 1) desc')
                // -> this will give you order by % CHANGE
     
                //->limit(10)->get();
                ->paginate(10);
           
     
            //foreach($accounts as $acc){
            //    print_r([
            //        'company' => $acc->handle,
            //        'diff' => $acc->today_value - $acc->past_value
            //    ]);
            
     
         //return $accounts;
     
         return view('rankings/t_abs', compact('accounts'));
     
            } 
    
            public function twitter_percentage_ten(){
                $description = Metric_description::find(1);  // TWITTER FOLLOWERS
         
                // $today = date('Y-m-d 0:0:0', time());
                $today = '2018-11-16';
                // WE WANT ONE MONTH / ONE WEEK / ONE XY..
                $past = '2018-11-03 00:00:00';
         
           
         
                $accounts = Account::with('company')->select([
                        '*',
                        DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                        DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
                    ])->where('network_id', $description->network_id)
                   
                    ->orderByRaw('((today_value / past_value) - 1) desc')
                    // -> this will give you Order by TOTAL CHANGE
                   
                    //->orderByRaw('((today_value / past_value) - 1) desc')
                    // -> this will give you order by % CHANGE
         
                    //->limit(10)->get();
                    ->paginate(10);    
               
         
                //foreach($accounts as $acc){
                //    print_r([
                //        'company' => $acc->handle,
                //        'diff' => $acc->today_value - $acc->past_value
                //    ]);
                
         
             //return $accounts;
         
             return view('rankings/t_pct', compact('accounts'));
         
                } 


    // YOUTUBE VIDEOS

                public function yviews_absolute_ten(){
                    $description = Metric_description::find(8);  // YOUTUBE VIDEO VIEWS
             
                    // $today = date('Y-m-d 0:0:0', time());
                    $today = '2018-11-16';
                    // WE WANT ONE MONTH / ONE WEEK / ONE XY..
                    $past = '2018-11-03 00:00:00';
             
               
             
                    $accounts = Account::with('company')->select([
                            '*',
                            DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                            DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
                        ])->where('network_id', $description->network_id)
                       
                       ->orderByRaw('(today_value - past_value) desc')
                        // -> this will give you Order by TOTAL CHANGE
                       
                        //->orderByRaw('((today_value / past_value) - 1) desc')
                        // -> this will give you order by % CHANGE
             
                        //->limit(10)->get();
                        ->paginate(10);
             
                    //foreach($accounts as $acc){
                    //    print_r([
                    //        'company' => $acc->handle,
                    //        'diff' => $acc->today_value - $acc->past_value
                    //    ]);
                    
             
                 //return $accounts;
             
                 return view('rankings/yv_abs', compact('accounts'));
             
                    } 
            
                    public function yviews_percentage_ten(){
                        $description = Metric_description::find(8);  // TWITTER FOLLOWERS
                 
                        // $today = date('Y-m-d 0:0:0', time());
                        $today = '2018-11-16';
                        // WE WANT ONE MONTH / ONE WEEK / ONE XY..
                        $past = '2018-11-03 00:00:00';
                 
                   
                 
                        $accounts = Account::with('company')->select([
                                '*',
                                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
                            ])->where('network_id', $description->network_id)
                           
                            ->orderByRaw('((today_value / past_value) - 1) desc')
                            // -> this will give you Order by TOTAL CHANGE
                           
                            //->orderByRaw('((today_value / past_value) - 1) desc')
                            // -> this will give you order by % CHANGE
                 
                            //->limit(10)->get();
                            ->paginate(10);    
                       
                 
                        //foreach($accounts as $acc){
                        //    print_r([
                        //        'company' => $acc->handle,
                        //        'diff' => $acc->today_value - $acc->past_value
                        //    ]);
                        
                 
                     //return $accounts;
                 
                     return view('rankings/yv_pct', compact('accounts'));
                 
                        } 


    // YOUTUBE SUBSCRIBERS

    public function ysubs_absolute_ten(){
        $description = Metric_description::find(7);  // YOUTUBE VIDEO VIEWS
 
        // $today = date('Y-m-d 0:0:0', time());
        $today = '2018-11-16';
        // WE WANT ONE MONTH / ONE WEEK / ONE XY..
        $past = '2018-11-03 00:00:00';
 
   
 
        $accounts = Account::with('company')->select([
                '*',
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
            ])->where('network_id', $description->network_id)
           
           ->orderByRaw('(today_value - past_value) desc')
            // -> this will give you Order by TOTAL CHANGE
           
            //->orderByRaw('((today_value / past_value) - 1) desc')
            // -> this will give you order by % CHANGE
 
            //->limit(10)->get();
            ->paginate(10);
 
        //foreach($accounts as $acc){
        //    print_r([
        //        'company' => $acc->handle,
        //        'diff' => $acc->today_value - $acc->past_value
        //    ]);
        
 
     //return $accounts;
 
     return view('rankings/ys_abs', compact('accounts'));
 
        } 

        public function ysubs_percentage_ten(){
            $description = Metric_description::find(7);  // TWITTER FOLLOWERS
     
            // $today = date('Y-m-d 0:0:0', time());
            $today = '2018-11-16';
            // WE WANT ONE MONTH / ONE WEEK / ONE XY..
            $past = '2018-11-03 00:00:00';
     
       
     
            $accounts = Account::with('company')->select([
                    '*',
                    DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                    DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
                ])->where('network_id', $description->network_id)
               
                ->orderByRaw('((today_value / past_value) - 1) desc')
                // -> this will give you Order by TOTAL CHANGE
               
                //->orderByRaw('((today_value / past_value) - 1) desc')
                // -> this will give you order by % CHANGE
     
                //->limit(10)->get();
                ->paginate(10);    
           
     
            //foreach($accounts as $acc){
            //    print_r([
            //        'company' => $acc->handle,
            //        'diff' => $acc->today_value - $acc->past_value
            //    ]);
            
     
         //return $accounts;
     
         return view('rankings/ys_pct', compact('accounts'));
     
            }



    // FACEBOOK FOLLOWERS

    

    public function facebook_absolute_ten(){
        $description = Metric_description::find(9);  // FACEBOOK FOLLOWERS
 
        // $today = date('Y-m-d 0:0:0', time());
        $today = '2018-11-23';
        // WE WANT ONE MONTH / ONE WEEK / ONE XY..
        $past = '2018-11-03 00:00:00';
 
   
 
        $accounts = Account::with('company')->select([
                '*',
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
            ])->where('network_id', $description->network_id)
           
           ->orderByRaw('(today_value - past_value) desc')
            // -> this will give you Order by TOTAL CHANGE
           
            //->orderByRaw('((today_value / past_value) - 1) desc')
            // -> this will give you order by % CHANGE
 
            //->limit(10)->get();
            ->paginate(10);
 
        //foreach($accounts as $acc){
        //    print_r([
        //        'company' => $acc->handle,
        //        'diff' => $acc->today_value - $acc->past_value
        //    ]);
        
 
     //return $accounts;
 
     return view('rankings/fb_abs', compact('accounts'));
 
        } 

        public function facebook_percentage_ten(){
            $description = Metric_description::find(9);  // FACEBOOK FOLLOWERS
     
            // $today = date('Y-m-d 0:0:0', time());
            $today = '2018-11-23';
            // WE WANT ONE MONTH / ONE WEEK / ONE XY..
            $past = '2018-11-03 00:00:00';
     
       
     
            $accounts = Account::with('company')->select([
                    '*',
                    DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $today . '") as `today_value`'),
                    DB::raw('(select `value` from `metric_values` where `value` IS NOT NULL and  `account_id` = `accounts`.`id` and `metric_description_id` = "' . $description->id . '" and `date` = "' . $past . '") as `past_value`')
                ])->where('network_id', $description->network_id)
               
                ->orderByRaw('((today_value / past_value) - 1) desc')
                // -> this will give you Order by TOTAL CHANGE
               
                //->orderByRaw('((today_value / past_value) - 1) desc')
                // -> this will give you order by % CHANGE
     
                //->limit(10)->get();
                ->paginate(10);    
           
     
            //foreach($accounts as $acc){
            //    print_r([
            //        'company' => $acc->handle,
            //        'diff' => $acc->today_value - $acc->past_value
            //    ]);
            
     
         //return $accounts;
     
         return view('rankings/fb_pct', compact('accounts'));
     
            }

    
}