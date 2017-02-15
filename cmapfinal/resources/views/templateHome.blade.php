<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CAME | Mapa Argentina Productiva</title>

		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		<link rel="icon" type="image/png" href="{{'img/icon.png'}}" sizes="57x57">

		<!-- Fonts -->
		<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">

		<link rel="stylesheet" href="{{URL::asset('css/maini.css')}}">
		<link rel="stylesheet" href="{{URL::asset('css/jquery-ui.css')}}">

		@yield('css');
		<script src="{{URL::asset('js/jquery.min.js')}}"></script>
		<script src="{{URL::asset('js/jquery-ui.js')}}"></script>
		<script src="{{URL::asset('js/bootstrap.js')}}"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAKAhYtwWh1bDZxldsKSRnNfdXyCEyLf4o&libraries=places"></script>
		@stack('script-header')
	
	</head>	
	<body>

		<div class="row">
			<img class="col-lg-12" src="{{asset('img/banner.fondo.fw.png')}}">
		</div>
		<div class="row">
			<div class="col-lg-12 text-right" style="background-color:#117AB4;color:white;padding:5px 20px 5px 10px;">Si sos PYME, sos CAME:!Sumate a nuestra Comunidad!</div>
		</div>
	<div class="row" style="background-color:#2698D4;">
		<a href="{{route('homepublic')}}">
		<div class="col-lg-6 " style="color:white;padding:5px 20px 5px 10px;">
				<div class="col-lg-offset-1"><span style="padding-left:10px">VIVÍ</span></div>
				<div class="col-lg-offset-1"style="border:1px solid white;font-weight:bold;width:190px;"><span style="padding-left:5px">ARGENTINA PRODUCTIVA</span></div>
	   </div></a>
        
       <div class="col-lg-6" style="color:white;min-height: 52px;">
       	    <a style="text-decoration:none" href="https://docs.google.com/forms/d/e/1FAIpQLSdXjVfNOT8_WHEzyHmKgOcUdRHCJMQvVzMYYZ_RnmVBo7SSDg/viewform" target="_blank"> <div class="col-lg-offset-6 sumate">SUMATE</div></a>
       </div>



	</div>

	<!--mensaje-->
	@if (Session::has('flash_message'))
		<div class="alert alert-info" style="position:absolute;top:18%;left:30%">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{ Session::get('flash_message') }}
		</div>
	@endif
	<!--end mesanje-->

	@yield('content')
	<div class="row">
		<div class="col-lg-12" id="footer" style="background-color:#949599;padding:20px">

			<div class="col-lg-4"><span style="margin-left:50px">Todos Los Derechos Reservados 2016</span></div>


			<div class="col-lg-8" style="color:#C7C8CA">
				<div style="margin-left:70%">

					<div  ><span style="padding-left:10px">VIVÍ</span></div>
					<div class=""style="border:1px solid #C7C8CA;font-weight:bold;width:190px;"><span style="padding-left:5px">ARGENTINA PRODUCTIVA</span></div>
				</div>

			</div>
		</div>
	</div>
	<!--script-->
	@stack('script-footer')
	<!--end script-->
	</body>
</html>