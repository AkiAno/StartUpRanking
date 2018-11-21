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

                                    
                                        $metrics = $account->metric_values()->where('metric_description_id', $desc->id)->first();
                                        if($metrics !== null){


                                            echo $network->name." ".$desc->description.": <b>".$metrics->value."</b><br>";
                                        }
                                        
                                    }
                                @endphp 
                                
                            </td>
                        @endforeach
                    @endforeach

    </div>
</div>

@endsection