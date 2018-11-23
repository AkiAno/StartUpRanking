@extends('layouts.app')
@section('content')


<div class="sub container mt-4">
    <h1> {{$company->name}} </h1>
    <div class="company-container container">
        <?php $accounts_array = [];?>
        {{-- <div class="item"><div class="header">WEBSITE:</div>{{ $company->website }}</div> --}}
       @foreach($networks as $network)
                        @foreach($network->metric_descriptions as $desc)
                        @if ($company !== null && $network !== null)
                            
                       
                            <div class="items">
                                
                                @php 
                                    $account = $company->accounts()->where('network_id', $network->id)->first();
                                    

                                    if($account !== null){
                                        array_push($accounts_array, [
                                            'account' => $account,
                                            'description' => $desc,
                                            'network' => $network
                                        ]);
                                        
                                        $metrics_prev = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '>=',$fromDate)->orderBy('date','ASC')->first();
                                        
                                        $metrics_cur = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<=',$toDate)->orderBy('date','DESC')->first();
                                            
                                        if($metrics_prev !== null){
                                            if($metrics_cur->value !== null){
                                                // dd(($metrics->value - $metrics_old->value));
                                                $percentage_shift = (($metrics_cur->value - $metrics_prev->value) / $metrics_prev->value)*100;
                                                echo '<div class="item"><span class="header">'.$network->name."</span> <span class='lowercase-letter'>".$desc->description.": </span>".$metrics_cur->value." ".'('.number_format((float)$percentage_shift, 2, '.', '').'%)</div><br>';
                                               // echo $network->name." ".$desc->description." ".$metrics->value."<br>";
                                            }
                                            
                                        }
                                        
                                    }
                                @endphp 
                                
                                </div>
                                @endif
                        @endforeach
                    @endforeach


    </div>

    @php
    
        
        $metric_values_per_account = [];

        foreach ($accounts_array as $account) {
            // $account['metricvalues'] 
            $metric_values_per_account[$account['account']->id] = $account['account']->metric_values()
                ->where('metric_description_id', $account['description']->id)
                ->orderBy('date','DESC')
                ->get();
        }
        
        #dd($network->id);
        // if($account !== null){
            
        //  $metricvalues = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<=',$toDate)->where('date', '>=', $fromDate)->orderBy('date','DESC')->get();
          
        // }           
        
        #dd($metricvalues);
@endphp

@foreach ($accounts_array as $account) 
    
    @php
        $metricvalues = $metric_values_per_account[$account['account']->id];
        $dataPoints = array();
        $format = 'Y-m-d';
        if(!empty($metricvalues)) {
            foreach($metricvalues as $metricvalue) {
                // dump($account);
            if($metricvalue){
                $date = DateTime::createFromFormat($format, $metricvalue->date);
                #dd($metricvalue->date);
                $datapoint = array("x" => $date->format('Y,m,d') , "y" => $metricvalue->value);
                array_push($dataPoints,$datapoint);
                }
            }
        }
        #dd($date->format($format));
        #$dataPoints = array("x" => 1, "y" => 1);
    @endphp

    <script>

        (function() {


            let dataPoints = JSON.parse('<?php echo json_encode($dataPoints)?>');
            // console.log(dataPoints);
            let maxValue = 0;
            let minValue = dataPoints[0].y;
            for(let i = 0; i < dataPoints.length; i++){
                dataPoints[i].x = new Date(dataPoints[i].x);
            }
            for(let i = 0; i < dataPoints.length; i++){
                if(maxValue < dataPoints[i].y) {
                    maxValue = dataPoints[i].y;
                }
                if(minValue > dataPoints[i].y) {
                    minValue = dataPoints[i].y;
                }
            }
            // console.log(minValue, maxValue);
            dataPoints = [
                            {
                                type: "line",
                                markerSize: 12,
                                xValueFormatString: "MMM, YYYY",
                                yValueFormatString: "###.#",
                                dataPoints: dataPoints
                            }
                        ];
                        console.log(dataPoints);

            if(dataPoints.length !== null){
                window.addEventListener('load', function() {
                    var chart = new CanvasJS.Chart("chartContainer{{ $account['account']->id.'-'.$account['network']->id.'-'.$account['description']->id }}", {
                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                        animationEnabled: true,
                        title: {
                            text: "{{ $account['network']->name.' '.$account['description']->description }}"
                        },
                        axisX: {
                            interval: 1,
                            intervalType: "month",
                            valueFormatString: "MMM"
                        },
                        axisY: {
                            title: "metrics value",
                            valueFormatString: "#0",
                            viewportMinimum: minValue-10,
                            viewportMaximum: maxValue+10
                        },
                        data: dataPoints
                    });
                    console.log('rendering {{ $account['network']->name }}');
                    chart.render();

                });
            }
            })();
    </script>
    <div id="chartContainer{{ $account['account']->id.'-'.$account['network']->id.'-'.$account['description']->id}}" style="height: 370px; width: 100%;"></div><br>

@endforeach
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>

@endsection