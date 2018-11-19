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

            <h1><b>ALEXA RANK % GROWTH -> 1 month</b></h1>        
            <table>


                        <tr>
                            <th>Rank+</th>
                            <th>Handle</th>
                            <th>Company</th>
                        </tr>
                        <tr>
                            @foreach ($accounts as $acc)
                            <td align="right"><b><?= (int)((($acc->past_value / $acc->today_value) -1)*100)."%" ?></b></td>

                            
                            
                            <td align="center"><?= $acc->company_id ?></td>
                            <td><?= $acc->handle ?></td>
                            
                            <td><?= $acc ?></td>
                        </tr>
                        
                          </tr>
                        
                          @endforeach
                        </table>

                       




@endsection