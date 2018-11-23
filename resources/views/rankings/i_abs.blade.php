@extends('layouts.app')

<link rel="stylesheet" href="/css/main.css">


@section('content')

<style>
.big {
  margin-top: 10px;
  margin-bottom: 10px;
  margin-left: 100px;
  margin-right: 100px;
}  

.month {
    display: flex;
  min-width: 150px;
  height: 80px;
  
}

.left {
    text-align: left;
}



.bottom {
  display: flex;
  justify-content: space-around; 
  height: 40px;
  align-items: center;
  

}

table {
    display: flex;
    text-align: right;
    width: 100%;
    
} 
.td {
    width: 200px;
}
th {
    width: 200px;
    text-align: center;
}

</style>
<br>
<div class="big">

            <div class="month">
               <div class="left"><h1>INSTAGRAM FOLLOWERS GROWTH</h1></div> 
               <div class="1month">(1 month)</div>        
            </div>
            <table>


                        <tr>
                            <th>Company</th>
                            <th>Followers Increase</th>
                            
                            <th align="right">Start Value</th>
                            <th align="right">Latest Value</th>
                            <th>Website</th>
                        
                        </tr>
                        
                        <tr>
                            @foreach ($accounts as $acc)
                            <td align="left"><a href="<?= $acc->company->id ?>"><?= $acc->company->name ?></td>
                            <!-- IN ALEXA => PAST - minus - PRESENT -->
                            <td align="right"><b><?= number_format($acc->today_value - $acc->past_value) ?></b></td>
                            
                            
                            
                                <td align="right"><?= $acc->past_value ?></td>
                                <td align="right"><?= $acc->today_value ?></td>
                                <td><a href="http://www.<?= $acc->company->website ?>"><?= $acc->company->website ?></td>
                            <!-- <td><= $acc ></td> -->
                        </tr>
                        
                          </tr>
                        
                          @endforeach
                        </table>

                        {{ $accounts->links() }}

                    </div>
                        <div class="bottom">
                                <br><br>

                                <p>Facebook:
                                        <a href="/facebook_abs">abs.</a> 
                                        <a href="/facebook_pct">%</a> 
                                    </p>

                                <p>Alexa:

                                <a href="/alexarank_abs">abs.</a> 
                                <a href="/alexarank_pct">%</a> 
                                </p>
                                <p>
                                Twitter:
                                <a href="/twitrank_abs">abs.</a> 
                                <a href="/twitrank_pct">%</a>
                            </p>
                            <p>
                                    Instagram Followers:
                                    <a href="/instarank_abs">abs.</a> 
                                <a href="/instarank_pct">%</a> 
                                Posts:
                                <a href="/instaprank_abs">abs.</a> 
                                <a href="/instaprank_pct">%</a> 

                                </p><p>
                                        Youtube Views:
                                        <a href="/youvrank_abs">abs.</a> 
                                <a href="/youvrank_pct">%</a> 
                                    Subscribers:
                                    
                                        <a href="/yousrank_abs">abs.</a> 
                                <a href="/yousrank_pct">%</a> 
                                    </p>
                        
                                

                                
                               
<!--
                                <a href="/youvrank_abs">Youtube Views</a> 
                                <a href="/youvrank_pct">Youtube Views %</a> 
                                 
                                
-->
                              </div>
                              <br><br><br>
                             








@endsection