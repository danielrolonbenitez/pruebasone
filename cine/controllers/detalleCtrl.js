app.controller("detalleCtrl", function($scope, $state, $http){
	$scope.traerPelicula = function() {
		//console.log($state.params.id);
		$http.get('detalle_' + $state.params.id + '.json').then(
			function(data) {
				console.log(data);
				$scope.pelicula = data.data;
			}, function(error){
				console.log(error);
			}
		)
	}
});
