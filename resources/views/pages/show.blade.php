@extends('layouts.app')
@section('content')

    <h1> {{$company->name}} </h1>
    <div>
       WEBSITE: {{$company->website}}
    </div>

@endsection