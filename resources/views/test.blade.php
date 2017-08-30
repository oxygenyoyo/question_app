<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('bootstrap/css/font-awesome.min.css')}}">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<title>Document</title>
	<style>
	body{
		font-family: 'trirong';
	}
	
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">
				<a href="{{route('q.test', [$lang, $question->id, $choice->id])}}">
					<img class="img-responsive center-block" src="{{URL::asset('uploads/' . $question->cover_name . '.' . $question->cover_ext)}}" alt="">			
				</a>
			</div>
		</div>
	</div>
	
<!-- jQuery 2.2.3 -->
<script src="{{URL::asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL::asset('plugins/jQueryUI/jquery-ui.min.js')}}"></script>
</body>
</html>