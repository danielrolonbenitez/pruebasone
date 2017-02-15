
<div class="row box-carousel"  style="padding-top:5px;padding-bottom:5px">


<div class="col-lg-1">
   <div style="margin-top:50px;margin-left:30px"><button class="btn btn-primary "  href="#" id="prev"><i class="glyphicon glyphicon-chevron-left"></i></button></div>

</div>



    
    <div class="col-lg-10" style="">

<div class="cycle-slideshow"
 data-cycle-fx="carousel"
  data-cycle-speed="450" 
  data-cycle-timeout="7000" 
  data-cycle-carousel-visible="4" 
  data-cycle-carousel-fluid="true" 
  data-cycle-prev="#prev" 
  data-cycle-next="#next"
  data-cycle-slides="> div"
  data-cycle-pause-on-hover="true">
        

            <?php foreach($fotosFiltros as $key=>$dato) 
                                        { 
                                          
                                          $foto=explode('public/',$dato->url);
    

                                      echo "<div style='margin-left:5px;padding:5px;word-wrap:break-word' class='cc'>

                                      <div style='position:relative;width:264px;box-sizing:border-box;word-wrap:break-word;'>
                                                <img  data-url='{$key}' style='margin-left:5px' src='{$foto[1]}' class='img-hover img-responsive'></img>
                                    
                                                <div class='showww'>".
                                                   "<div class='title-data' style='height:auto;word-wrap:break-word;max-width:264px'>".$dato->razonSocial."</div>".
                                                     "<div class='title-content margin'>".$dato->cnombre."</div>".
                                                    "<div class='title-content'>".$dato->pnombre."&nbsp;Argentina</div>".
                                                 "</div></div>
                                          
                                          </div>";


                                        

                                           

                                          }

                                        

              
        


        ?>







</div>


    </div>
 



<div class="col-lg-1">
     <div style="color:white;z-index:1000;margin-top:50px;margin-left:20px"> <button class="btn btn-primary" href="#" id="next"><i class="glyphicon glyphicon-chevron-right"></i></button></div>
</div>

</div>



<script>


$( document ).ready(function() {
 
 $( '.cycle-slideshow' ).cycle();

});

</script>

<style type="text/css">

</style>