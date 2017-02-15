<html>
<head>
<link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
</head>

<body>


<div class="row">
				
			<div  class="col-lg-4 col-lg-offset-2 loginForm">
				<form id="pepe" action="{{ action('LoginController@validaUser')}}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">


				  <div class="form-group">
				    <label for="email">Email:</label> 
				    <input type="email" class="form-control" id="email">
				  </div>
				  <div class="form-group">
				    <label for="pwd">Password:</label>
				    <input type="password" class="form-control" id="pwd">
				  </div>
				  
				  <button type="submit" class="btn btn-primary">Ingresar</button>
				 
				</form>
			</div>

</div>

<!--script-->

<script scr="{{URL::asset('js/bootstrap.css')}}"></script>





</body>

</html>
