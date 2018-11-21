@extends('layouts.app')
@section('content')



<style>

.sub {
    margin: 50px;
}

</style>

<div class="sub">
    <h1> {{$company->name}} </h1>
    <div>
       WEBSITE: <a href="http://www.{{ $company->website }}">{{ $company->website }}</a>
        <br>
       @foreach($networks as $network)
                        @foreach($network->metric_descriptions as $desc)
                            <td>
                                

                                @php 
                                    $account = $company->accounts()->where('network_id', $network->id)->first();
                                    
                                    if($account !== null){

                                    
                                        $metrics = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '=',$toDate)->orderBy('date','DESC')->get();

                                        $metrics_old = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '=', $fromDate)->orderBy('date','DESC')->get();

                                        
                                        
                                        if($metrics !== null){


                                            
                                            if($metrics_old !== null){
                                                $percentage_shift = 100 *($metrics - $metrics_old) / $metrics_old);
                                                echo $network->name." ".$desc->description." ".$metrics." ".'('.number_format((float)$percentage_shift, 2, '.', '').'%)<br>';
                                               // echo $network->name." ".$desc->description." ".$metrics->value."<br>";
                                            }
                                            
                                        }
                                        
                                    }
                                @endphp 
                                
                            </td>
                        @endforeach
                    @endforeach

    </div>
</div>

@endsection