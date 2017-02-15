<html>
<head>
<title>CAME | Mapa Argentina Productiva</title>
<link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
<link rel="icon" type="image/png" href="{{'img/icon.png'}}" sizes="57x57">
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.js')}}"></script>
</head>

<body class="body">


<div class="row">
			 <!--mensaje-->
								@if (Session::has('flash_message'))
						   			 <div class="alert alert-info" style="position:absolute;top:0%;left:45%">
						   			 	<button type="button" class="close" data-dismiss="alert">&times;</button>
						   			 	{{ Session::get('flash_message') }}

						   			 </div>
								@endif
					<!--end mesanje-->
			<div class="col-lg-12  col-lg-offset-4" style="padding-top:50px;padding-left:50px;">
					<img src="img/came.png" width="300" height="auto">
			</div>

			<div  class="col-lg-4 col-lg-offset-4" style="padding:30px;margin-top:5%;color:white;background:rgba(0,0,0,0.5)">
					

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
