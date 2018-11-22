@extends('layouts.app')

<link rel="stylesheet" href="/css/main.css">


@section('content')
<div id="date-picker"></div>
<div class="data container">
       @include('pages/table')
</div>
<script src="{{mix('js/app.js')}}"></script> 
<script src="{{mix('js/calendar.js')}}"></script> 
@endsection