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
                        <a href="/{{ $comp->id }}" style='' class="company-name">
                            {{$comp->name}}
                        </a>
                    </td>
                    @foreach($networks as $network)
                        @foreach($network->metric_descriptions as $desc)
                            <td>
                                @php 

                                    $account = $comp->accounts()->where('network_id', $network->id)->first();
                                    
                                    if($account !== null){
                                        
                                        $metrics_prev = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '>=',$fromDate)->orderBy('date','ASC')->first();
                                        
                                        $metrics_cur = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<=',$toDate)->orderBy('date','DESC')->first();

                                        if($metrics_prev !== null){
                                            if($metrics_cur !== null){
                                                $percentage_shift = (($metrics_cur->value - $metrics_prev->value) / $metrics_prev->value)*100;
                                                echo $metrics_cur->value." ".'<br><span class="percentage" style="color:#3490dc; font-weight:300; font-size:0.9rem;">('.number_format((float)$percentage_shift, 2, '.', '').'%)</span><br>';
                                               
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

        <script>
            window.onload(){
                let persentage = parseInt('<?php echo json_encode($percentage_shift)?>');
                console.log(persentage);
                let element = document.getElementsByClassName('percentage');
                        if(persentage > 0 ){
                            element.style.color="green";
                        } else {
                            element.style.color="red";
                        }
                    }
                }
        </script>