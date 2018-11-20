@extends('layouts.app')
@section('content')

    <h1> {{$company->name}} </h1>
    <div>
       WEBSITE: {{ $company->website }}
        <br>
       @foreach($networks as $network)
                        @foreach($network->metric_descriptions as $desc)
                            <td>
                                

                                @php 

                                    $account = $company->accounts()->where('network_id', $network->id)->first();
                                    
                                    if($account !== null){

                                    
                                        $metrics = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<',$toDate)->where('date', '>=', $fromDate)->orderBy('date','DESC')->first();

                                        $metrics_old = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<',$toDate)->where('date', '>=', $fromDate)->orderBy('date','ASC')->first();


                                        if($metrics !== null){


                                            
                                            if($metrics_old !== null){
                                                $percentage_shift = 100 *($metrics->value - $metrics_old->value) / $metrics_old->value;
                                                echo $network->name." ".$desc->description." ".$metrics->value." ".'('.number_format((float)$percentage_shift, 2, '.', '').'%)<br>';
                                               // echo $network->name." ".$desc->description." ".$metrics->value."<br>";
                                            }
                                            
                                        }
                                        
                                    }
                                @endphp 
                                
                            </td>
                        @endforeach
                    @endforeach

    </div>

@endsection