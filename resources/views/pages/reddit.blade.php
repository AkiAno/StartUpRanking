@extends('layouts.app')

<link rel="stylesheet" href="/css/main.css">

@section('content')

<form method="post" class="reddit-form container">
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

<div class="container">
	{!! $response !!}
	
</div>

	<script>
			document.getElementsByName('headline_urlsource_type');
			let sentimic_analyze = '<?php echo json_encode($evaluations)?>';
			let elements = document.getElementsByClassName('sentimic-analyze');
				for (var i = 0; i < elements.length; i++) {
					if(elements[i].innerHTML == 'positive'){
						elements[i].style.color="green";
					} else if (elements[i].innerHTML == 'neutral'){
						elements[i].style.color="blue";
					} else {
						elements[i].style.color="red";
					}
				}
			// for(let i = 0; i < sentimic_analyze.length; i++){
			// 	let sentimic_color = document.querySelector('.sentimic-analyze');
			// 	if(sentimic_analyze[i] == 'positive') {
			// 		sentimic_color.className = 'sentimic-analyze positive';
			// 	} else {
			// 		sentimic_color.className = 'sentimic-analyze negative';
			// 	}
			// }
			
	</script>



@endsection