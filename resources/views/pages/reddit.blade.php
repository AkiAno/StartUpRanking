@extends('layouts.app')

<link rel="stylesheet" href="/css/main.css">

@section('content')

<form method="post">
	@csrf
	<select name="headline_urlsource_name" id="headline_urlsource_name" onchange="this.form.submit()">
		<option>Select a feed</option>
	  @foreach($arr as $key => $value)
	    <option value="{{ $key }}" {{ $key==$headline_urlsource_name ? "selected" : ""}}>>{{ $key }}</option>
	  @endforeach
	</select>

	<input type="radio" <?php echo $checked_new; ?> value="headline_urlsource_new" name="headline_urlsource_type" id="headline_urlsource_new"> New only
	<input type="radio" <?php echo $checked_top; ?> value="headline_urlsource_top" name="headline_urlsource_type" id="headline_urlsource_top"> Top only


</form>

<div>
	{!! $response !!}
	
</div>

@endsection