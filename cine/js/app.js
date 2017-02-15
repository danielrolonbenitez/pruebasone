var app = angular.module('cine', ['ui.router']);

app.controller('mainCtrl',function($scope){
	
});

app.config(function($stateProvider,$urlRouterProvider){
	$stateProvider.state('listado', {
		templateUrl:'views/listado.html',
		url:'/listado',
		controller: 'peliculasCtrl'
	});
	$stateProvider.state('detalle', {
		templateUrl:'views/detalle.html',
		url:'/detalle/:id'
	});
	$urlRouterProvider.otherwise('/listado');
});


/* app.controller('receptor', function($scope, $state, $http){
	$scope.traerPelicula = function() {
		$http.get('movies_' + state.params.id + '.json').then(
			function(data) {
				console.log('data');
			}, function(error){
				console.log('error');
			}
		)
	}
}); */