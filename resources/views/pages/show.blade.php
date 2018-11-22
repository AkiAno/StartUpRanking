@extends('layouts.app')
@section('content')



<style>

.sub {
    margin: 50px;
}

</style>

<div class="sub">
    <h1> {{$company->name}} </h1>
    <div style='height:70vw;'>
       WEBSITE: {{ $company->website }}
        <br>
       @foreach($networks as $network)
                        @foreach($network->metric_descriptions as $desc)
                            <td>
                                @php 
                                    $account = $company->accounts()->where('network_id', $network->id)->first();
                                    
                                    if($account !== null){

                                    
                                        $metrics = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<=',$toDate)->where('date', '>=', $fromDate)->orderBy('date','DESC')->first();

                                        $metrics_old = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<=',$toDate)->where('date', '>=', $fromDate)->orderBy('date','ASC')->first();


                                        if($metrics !== null){


                                            
                                            if($metrics_old !== null){
                                                $percentage_shift = 100 *($metrics->value - $metrics_old->value) / $metrics_old->value;
                                                echo $network->name." ".$desc->description." ".$metrics->value." ".'('.number_format((float)$percentage_shift, 2, '.', '').'%)<br>';
                                               echo $network->name." ".$desc->description." ".$metrics->value."<br>";
                                            }
                                            
                                        }
                                        
                                    }
                                @endphp 
                                
                            </td>
                        @endforeach
                    @endforeach


<td>
    @php
        $account = $company->accounts()->where('network_id', $network->id)->first();
        $desc = $network->metric_descriptions()->first();
        
        #dd($account);
        if($account !== null){
            
            

            $metricvalues = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<=',$toDate)->where('date', '>=', $fromDate)->orderBy('date','DESC')->get();
            
        }           
        
        #dd($metricvalues);

    $dataPoints = array();
    $format = 'Y-m-d';
    foreach($metricvalues as $metricvalue) {

        $date = DateTime::createFromFormat($format, $metricvalue->date);
        #dd($metricvalue->date);
        $datapoint = array("x" => $date->format('U') , "y" => $metricvalue->value);
        $dataPoints[] = $datapoint;
    }

    #dd($date->format($format));
 @endphp


</td>

<div>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "startup ranking"
	},
	axisY: {
		title: "metric value",
		valueFormatString: "#0,,.",
		suffix: "",
		prefix: ""
	},
	data: [{
		type: "spline",
		markerSize: 5,
		xValueFormatString: "Y-m-d",
		yValueFormatString: "#,##.##",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
 
chart.render();
 
}
</script>
</div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>

@endsection