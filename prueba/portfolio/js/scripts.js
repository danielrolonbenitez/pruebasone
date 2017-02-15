$(function () {
	setMenu();
	setParallax();
});

function setMenu(){
	 $(".button-collapse").sideNav();
	 $('.mdi-navigation-menu').on('click', function(event) {
	 	event.preventDefault();
	 	console.log('click');
	 });
}

function setParallax(){
	$('.parallax').parallax();
}