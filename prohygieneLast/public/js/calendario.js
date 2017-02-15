
  var f = new Date();
   $fecha= f.getFullYear()+ "/" + (f.getMonth() +1) + "/" +f.getDate();

   
     $.ajax({
                
                url:   'r',
                type:  'get',
               beforeSend: function () {
                    
                },
               success:  function (response) {
                        
              

                         
                
         $('#calendar').fullCalendar("removeEvents");   



          $('#calendar').fullCalendar({
      defaultDate: $fecha,
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      lang: 'es',
      eventOrder: 'id',

       eventClick: function(calEvent, jsEvent, view) {
        //console.log(calEvent.descripcion);//toma los datos de R //para que esten disponible deben estar cargados en event push//
        var d=calEvent.descripcion;
        var destinadoA=calEvent.destinadoA;
        var nombreCurso=calEvent.nombreCurso;
        var desCurso=calEvent.desCurso;
        var capacitador=calEvent.capacitador;
        
        var f=calEvent.fechaB;
            f=f.split('-');
            var y=f[0];
            var m=f[1];
            var day=f[2];
        console.log(f);
        var periodoNombre=calEvent.periodoNombre;

          
        $('#myModal').modal('show');
        
        $('.modal-destinadoA').html('<b>Destinado A:</b>'+' '+destinadoA);
        $('.modal-cursoNombre').html('<b>Curso:</b>'+' ' +nombreCurso);
        $('.modal-desCurso').html('<b>Detalle:</b>'+' ' +desCurso);
        $('.modal-capacitador').html('<b>capacitador:</b>'+' '+capacitador);
        $('.modal-fecha').html(day+"/"+m+"/"+y);
        $('.modal-periodoNombre').html(periodoNombre);
        $('.modal-descripcion').html(d);
       

        }
      
   
          });//end calendar//

//carga los datos en calevent qque se toman del //
      var cant=response.length;

           var events=[];
            var i;

            for(i=0;i<cant;i++){

             events.push({
                        title: response[i]['destinadoA']+"\n" + response[i]['nombreCurso']+"\n"+response[i]['desCurso'],
                        start: response[i]['fechaI'],
                        end: response[i]['fechaE'], // will be parsed
                        descripcion:response[i]['descripcion'],
                        destinadoA:response[i]['destinadoA'],
                        nombreCurso:response[i]['nombreCurso'],
                        desCurso:response[i]['desCurso'],
                        fechaB:response[i]['fechaI'],
                        color:response[i]['color'],
                        capacitador:response[i]['capacitador'],
                        periodoNombre:response[i]['periodoNombre'],
                       
                      
                    });

                }





           $('#calendar').fullCalendar('addEventSource', events);  
         //$('#calendar').fullCalendar('refetchEvents');
         

   






                       

                }//en succes
        


        });//en ajax

  



//end cargacurso calendario//








