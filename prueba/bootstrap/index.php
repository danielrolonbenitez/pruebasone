<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="../css/bootstrap.css">
		<script src="../js/jquery.js" ></script>
		<script src="../js/bootstrap.js" ></script>
		<style>
         .fondo{padding:30px;background:silver;}
         body { padding-top: 100px; }

       </style>
       <script>
        
       $(document).ready(function(){

           $('#pepe').on('click',function(event){
           	   alert("presiono");
           });
         
         
            $x= $(window).width();
            if($x<800){
             
             $('nav').removeClass('navbar-fixed-top');
            } 


        });

       </script>
	</head>
  <body>
  	 <header>
  	 	     <nav  class="navbar navbar-default navbar-fixed-top n">
  	 	     	<div  class="row" >
  	 	     	  <div id="pepe" class="col-lg-3 " style="background:red;padding:30px">INICIO</div>
  	 	     	  <div class="col-lg-3 fondo">NOSOTROS</div>
  	 	     	  <div class="col-lg-3 fondo">CATALOGO</div>
  	 	     	  <div class="col-lg-3 fondo">CONTACTO</div>
  	 	       </div>
  	 	     </nav>

  	 </header>
     
   <div class="row">
    	<div class="col-lg-6" style="background:black;height:400px">
    		contenido
    	</div>

        <div class="col-lg-6">
        	<div class="row">
        		 <div class="col-lg-12" style="background:orange;height:200px">foto1</div>
        		 <div class="col-lg-12"style="background:pink;height:200px">foto2</div>
        	</div>
        
        </div>
        	

   </div>
    <div class="row" style="height:300px;background:blue">
    	    <div class="col-lg-12">contactanos</div>
			    <div class="col-lg-12">email</div>
    </div>



   </div>







  </body>



</html>