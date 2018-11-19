@extends('layouts.app')

<link rel="stylesheet" href="/css/main.css">


@section('content')



        
            <table>
                <tr>
                    <th> ONE </tr>
                    <th> TWO </tr>   
                <tr>
            @foreach ($accounts-> as $acc => $handle)
             
                <tr>
                    <th><?= $handle ?></tr>
                    <th><?= $today_value - $past_value ?></tr>   
                <tr>
            @endforeach
    
        
       

@endsection