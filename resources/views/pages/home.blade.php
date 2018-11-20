@extends('layouts.app')

<link rel="stylesheet" href="/css/main.css">


@section('content')

<div class="container flex">
      <div class="example"></div>
    <div class="month">
        <label>
            Month
            <input type="radio" data-role="segmented" name="view" value="month" class="md-view-change"  checked>
        </label>
        <div id="demo"></div>
    </div>
    <div class="month">
        <label>
            Month
            <input type="radio" data-role="segmented" name="view" value="month" class="md-view-change"  checked>
        </label>
        <div id="demo"></div>
    </div>
</div>




<div class="data container">
        <table class="table table-lg-responsive">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Company's name
                    </th>
                    @foreach($networks as $network)
                        @foreach($network->metric_descriptions as $desc)
                            <th>
                                {{$network->name}} {{$desc->description}}
                            </th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>
            <tbody>
                    @foreach($companies as $comp)
                <tr>
                    <td>
                        {{$comp->id}}
                    </td>
                    <td>
                        <a href="/{{ $comp->id }}" style='color:black;'>
                            {{$comp->name}}
                        </a>
                    </td>
                    @foreach($networks as $network)
                        @foreach($network->metric_descriptions as $desc)
                            <td>
                                @php 

                                    $account = $comp->accounts()->where('network_id', $network->id)->first();
                                    
                                    if($account !== null){

                                    
                                        $metrics = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<',$toDate)->where('date', '>=', $fromDate)->orderBy('date','DESC')->first();

                                        $metrics_old = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<',$toDate)->where('date', '>=', $fromDate)->orderBy('date','ASC')->first();

                                        if($metrics !== null){
                                            if($metrics_old !== null){
                                                $percentage_shift = 100 *($metrics->value - $metrics_old->value) / $metrics_old->value;
                                                echo $metrics->value;
                                                echo '<br>('.number_format((float)$percentage_shift, 2, '.', '').'%)';
                                            }
                                            
                                        }
                                        
                                    }
                                @endphp 
                                
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                
                @endforeach
            </tbody>
        </table>
</div>

<div id="react-graph">
</div>
<script src="{{mix('js/app.js')}}"></script> 

@endsection