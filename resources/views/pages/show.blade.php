@extends('layouts.app')
@section('content')


<div class="sub container mt-4">
    <h1> {{$company->name}} </h1>
    <div class="company-container container">
        {{-- <div class="item"><div class="header">WEBSITE:</div>{{ $company->website }}</div> --}}
       @foreach($networks as $network)
                        @foreach($network->metric_descriptions as $desc)
                        @if ($company !== null && $network !== null)
                            
                       
                            <div class="items">
                                
                                @php 
                                    $account = $company->accounts()->where('network_id', $network->id)->first();
                                    
                                    if($account !== null){
                                        
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
<td>
    @php
    
        $account = $company->accounts()->first();
        $network = $account->network()->first();
        $desc = $network->metric_descriptions()->first();
        
        #dd($network->id);
        if($account !== null){
            
         $metricvalues = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<=',$toDate)->where('date', '>=', $fromDate)->orderBy('date','DESC')->get();
          
        }           
        
        #dd($metricvalues);

    $dataPoints = array();
    $format = 'Y-m-d';
    foreach($metricvalues as $metricvalue) {

        $date = DateTime::createFromFormat($format, $metricvalue->date);
        #dd($metricvalue->date);
        $datapoint = array("x" => $date->format('Y,m,d') , "y" => $metricvalue->value);
        $dataPoints[] = $datapoint;
    }
    #dd($date->format($format));
    #$dataPoints = array("x" => 1, "y" => 1);
 @endphp


</td>

<div>
    <script>
        let companyName = '<?php echo $company->name?>'
        console.log(companyName);
        let dataPoints = JSON.parse('<?php echo json_encode($dataPoints)?>');
        console.log(dataPoints);
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
        console.log(minValue, maxValue);
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
        window.onload = function() {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                    animationEnabled: true,
                    title: {
                        text: companyName
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
                chart.render();
            };
    </script>
</div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div><br><br>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>

@endsection