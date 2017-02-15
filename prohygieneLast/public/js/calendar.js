 $date = new Date();
 $d = $date.getDate();
 $m = $date.getMonth()+1;
$y = $date.getFullYear();
$fecha=$y+"-"+$m+"-"+$d;




    $('#calendar').fullCalendar({
      defaultDate: '2016-03-16',
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      lang: 'es',
      eventOrder: '-title',

    events: {
        url: 'r',

        error: function() {
                console.log('error');
            }
    
		}



   
    });//end calendar//


    