app.controller('aboutUsCtrl', function($scope, $location, appData, $state) {

    appData.tituloSeccion = 'Acerca de nosotros';
    appData.seccionActual = 'aboutUs';

    $scope.back = function() {
        history.back();
        $location.replace();
    }

    $scope.version = '1.0.0';

    $scope.version = $state.params.version;

})