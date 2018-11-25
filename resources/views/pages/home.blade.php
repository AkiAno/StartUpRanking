@extends('layouts.app')

<link rel="stylesheet" href="/css/app.css">


@section('content')
<div id="date-picker" class="mt-2"></div>
<div id="data" class="data container">
       @include('pages/table')
</div>
<script src="{{mix('js/app.js')}}"></script> 
<script src="{{mix('js/calendar.js')}}"></script> 
@endsection
