$(document).ready(function(){
  

// Instantiate the Bootstrap carousel
$('.multi-item-carousel').carousel({
 interval: 3000
});

// for every slide in carousel, copy the next slide's item in the slide.
// Do the same for the next, next item.
$('.multi-item-carousel .item').each(function(){
    var next = $(this);
    var last;
    for (var i=0;i<3;i++) {
        next=next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        
        last=next.children(':first-child').clone().appendTo($(this));
    }
    last.addClass('rightest');
 
});




});




