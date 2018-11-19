@extends('layouts.app')

<link rel="stylesheet" href="/css/main.css">


@section('content')

<style>
.table {
    display: flex;
    text-align: right;
    
} 
.td {
    width: 200px;
}
.th {
    width: 200px;
}

</style>

            <h1><b>INSTAGRAM GROWTH -> 1 month</b></h1>        
            <table>


                        <tr>
                            <th>Rank+</th>
                            <th>Handle</th>
                            <th>Company</th>
                        </tr>
                        <tr>
                            @foreach ($accounts as $acc)
                            <!-- IN INSTA => TODAY - minus - PAST -->
                            <td align="right"><?= $acc->today_value - $acc->past_value ?></td>
                            
                            <td align="center"><?= $acc->company_id ?></td>
                            <td><?= $acc->handle ?></td>
                            
                            <td><?= $acc ?></td>
                        </tr>
                        
                          </tr>
                        
                          @endforeach
                        </table>

                       









@endsection