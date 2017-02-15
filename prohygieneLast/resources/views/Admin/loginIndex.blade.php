<!DOCTYPE html>
<html lang="en">
<head>
<title>Blog Prohygiene</title>
<link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
<link rel="shortcut icon" href="http://blogprohygiene.staging.vnstudios.io/wp-content/uploads/2014/12/favicon.ico" type="image/x-icon">
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.js')}}"></script>
</head>

<body class="body">


<div class="row">
			 <!--mensaje-->
								@if (Session::has('flash_message'))
						   			 <div class="col-lg-4 col-lg-offset-4 alert alert-danger" style="top:20px">
						   			 	<button type="button" class="close" data-dismiss="alert">&times;</button>
						   			 	{{ Session::get('flash_message') }}

						   			 </div>
								@endif
					<!--end mesanje-->
	
			<div  class="col-lg-4 col-lg-offset-4" style="padding:50px;margin-top:5%;color:white;background:rgba(0,0,0,0.5)">
				<form id="pepe" action="{{ route('validaUser')}}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">


				  <div class="form-group">
				    <label for="email">Email:</label>
				    <input type="email" class="form-control" name="email" placeholder="Email" required/>
				  </div>
				  <div class="form-group">
				    <label for="pwd">Password:</label>
				    <input type="password" class="form-control" name="password" placeholder="Password" required/>
				  </div>
				  
				  <button type="submit" class="btn btn-default">Ingresar</button>
				  
				
				</form>
			</div>

</div>





</body>

</html>