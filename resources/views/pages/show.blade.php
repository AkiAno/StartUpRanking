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

                                    
                                        $metrics = $account->metric_values()->where('metric_description_id', $desc->id)->first();
                                        if($metrics !== null){


                                            echo $network->name." ".$desc->description." ".$metrics->value."<br>";
                                        }
                                        
                                    }
                                @endphp 
                                
                            </td>
                        @endforeach
                    @endforeach

    </div>

@endsection