@extends('layouts.app')

<link rel="stylesheet" href="/css/main.css">


@section('content')

<style>

.big {
  margin: 50px;
}  

.bottom {
  display: flex;
  justify-content: space-around; 
  height: 80px;
  align-items: center;

}

.table {
    display: flex;
    text-align: right;
    
} 
.td {
    width: 200px;
}
.th {
    width: 200px;
}

</style>
<div class="big">
            <h1><b>YOUTUBE VIEWS GROWTH -> 1 month</b></h1>        
            <table>


                        <tr>
                            <th>Rank+</th>
                            <th>Handle</th>
                            <th>Company</th>
                        </tr>
                        <tr>
                            @foreach ($accounts as $acc)
                            
                            <td align="right"><?= $acc->today_value - $acc->past_value ?></td>
                            
                            <td align="center"><?= $acc->company_id ?></td>
                            <td><?= $acc->handle ?></td>
                            
                            <td><?= $acc ?></td>
                        </tr>
                        
                          </tr>
                        
                          @endforeach
                        </table>

                       
                        <div class="bottom">
                            <br><br>
                            <a href="/alexarank_abs">Alexa</a> 
                            <a href="/alexarank_pct">Alexa %</a> 
                            <a href="/youvrank_abs">Youtube Views</a> 
                            <a href="/youvrank_pct">Youtube Views %</a> 
                            <a href="/twitrank_abs">Twitter</a> 
                            <a href="/twitrank_pct">Twitter %</a> 
                            <a href="/instarank_abs">Instagram</a> 
                            <a href="/instarank_pct">Instagram %</a> 
                          </div>
                          <br><br><br>
                          </div>








@endsection