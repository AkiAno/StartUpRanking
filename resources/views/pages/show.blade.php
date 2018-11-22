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
                                        
                                        $metrics_prev = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '>=',$fromDate)->orderBy('date','ASC')->first();
                                        
                                        $metrics_cur = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<=',$toDate)->orderBy('date','DESC')->first();

                                    if($metrics_prev !== null){
                                            if($metrics_cur->value !== null){
                                                // dd(($metrics->value - $metrics_old->value));
                                                $percentage_shift = (($metrics_cur->value - $metrics_prev->value) / $metrics_prev->value)*100;
                                                echo $network->name." ".$desc->description." ".$metrics_cur->value." ".'('.number_format((float)$percentage_shift, 2, '.', '').'%)<br>';
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