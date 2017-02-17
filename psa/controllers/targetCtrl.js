app.controller('targetCtrl', function($scope, $state, $mdDialog, appData) {

    appData.tituloSeccion = 'Unidades';
    appData.seccionActual = 'units';


    $scope.submit = function(dataForm) {

        //console.log(dataForm);

        $state.go('app.calculator', {
            units: dataForm.unit,
            volume: dataForm.volume
        });
    }


})