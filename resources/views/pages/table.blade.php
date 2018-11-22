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
                                        
                                        $metrics_prev = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '>=',$fromDate)->orderBy('date','ASC')->first();
                                        
                                        $metrics_cur = $account->metric_values()->where('metric_description_id', $desc->id)->where('date', '<=',$toDate)->orderBy('date','DESC')->first();

                                        if($metrics_prev !== null){
                                            if($metrics_cur !== null){
                                                $percentage_shift = (($metrics_cur->value - $metrics_prev->value) / $metrics_prev->value)*100;
                                                echo $metrics_cur->value." ".'('.number_format((float)$percentage_shift, 2, '.', '').'%)<br>';
                                               
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