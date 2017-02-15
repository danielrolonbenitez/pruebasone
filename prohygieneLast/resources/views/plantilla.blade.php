<!DOCTYPE html>
<html lang="en">

<head>

		<title>Blog Prohygiene</title>
		<link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}"/>
		<link rel="stylesheet" href="{{URL::asset('css/jquery-ui.css')}}"/>
		@stack('css')
</head>

<body>

@yield('content')

<!--begin script -->
 <script src="{{URL::asset('js/jquery.min.js')}}"></script>
 <script src="{{URL::asset('js/bootstrap.js')}}"></script>
 @stack('script')

<!--end script-->


</body>

</html>
