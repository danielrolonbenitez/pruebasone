app.controller('calculatorCtrl', function($scope, $mdDialog, $state, appData, targetService, model, $localStorage, $sessionStorage) {

    appData.tituloSeccion = 'Calculador';
    appData.seccionActual = 'calculator';

    $scope.initCalculator = function() {
        if (typeof $localStorage.currentTarget == 'undefined') {
            //Target por default
            console.log('Entro al target por default');
            $localStorage.currentTarget = {
                userQuantity: 1730,
                target: 1730,
                sunny: 0,
                activity: 0,
                sex: 1,
                weight: 0
            };
        }
        $scope.$storage = $localStorage;

        $scope.dataTarget = targetService.get($scope.$storage);

        if ($scope.dataTarget.sunny) {
            //console.log('Entro al IF de SUNNY');
            $scope.dataTarget.sunnyQuantity = 300;
        } else {
            //console.log('Entro al ELSE de SUNNY');
            $scope.dataTarget.sunnyQuantity = 0;
        }

        if ($scope.dataTarget.activity) {
            //console.log('Entro al IF de ACTIVITY');
            $scope.dataTarget.activityQuantity = 450;
        } else {
            //console.log('Entro al ELSE de ACTIVITY');
            $scope.dataTarget.activityQuantity = 0;
        }

        if ($scope.dataTarget.sunny) {
            $scope.sunnyImg = 'sunny_active@2x.png';
        } else {
            $scope.sunnyImg = 'sunny@2x.png';
        }

        if ($scope.dataTarget.activity) {
            $scope.activityImg = 'directions_bike_active@2x.png';
        } else {
            $scope.activityImg = 'directions_bike@2x.png';
        }

        $scope.volume = 'ml';

        dataTarget = $scope.dataTarget;

        dataTarget.total = dataTarget.userQuantity + dataTarget.sunnyQuantity + dataTarget.activityQuantity;


        //Obtengo el user para setear la propiedad targetModifiedInHome
        if (!$localStorage.userInfo || !$localStorage.userInfo.length) {
            $localStorage.userInfo = [];
        }
        $scope.$storage = $localStorage;

        $scope.today = new Date();
        $scope.today.setHours(0, 0, 0, 0);

        $scope.service = model;
        $scope.userInfo = $scope.service.get($scope.today.getTime(), $scope.$storage);

        //Seteo la propiedad
        $scope.userInfo.targetModifiedInHome = false;
    }


    function updateTotal() {
        var userQuantity = dataTarget.weight * 35,
            sunnyQuantity = parseInt(dataTarget.sunnyQuantity),
            activityQuantity = parseInt(dataTarget.activityQuantity),
            newTotal = userQuantity + sunnyQuantity + activityQuantity,
            max = 9999;

        console.log(newTotal);

        if (newTotal > max) {
            //dataTarget.userQuantity = max;
            dataTarget.total = max;
        } else if (isNaN(userQuantity)) {
            //newTotal = 0;
            dataTarget.userQuantity = 0;
            dataTarget.total = sunnyQuantity + activityQuantity;
        } else if (newTotal > 0) {
            dataTarget.userQuantity = userQuantity;
            dataTarget.total = userQuantity + sunnyQuantity + activityQuantity;
        } else {
            dataTarget.total = newTotal;
        }

    }

    $scope.updateTotal = function() {
        updateTotal()
    }

    $scope.updateSunny = function() {
        if (dataTarget.sunny) {
            $scope.sunnyImg = 'sunny_active@2x.png';
            $scope.sunny = dataTarget.sunny;
            dataTarget.sunnyQuantity = 300;
            updateTotal();
        } else {
            $scope.sunnyImg = 'sunny@2x.png';
            $scope.sunny = dataTarget.sunny;
            dataTarget.sunnyQuantity = 0;
            updateTotal();
        }
    }

    $scope.updateActivity = function() {
        if (dataTarget.activity) {
            $scope.activityImg = 'directions_bike_active@2x.png';
            $scope.activity = dataTarget.activity;
            dataTarget.activityQuantity = 450;
            updateTotal();
        } else {
            $scope.activityImg = 'directions_bike@2x.png';
            $scope.activity = dataTarget.activity;
            dataTarget.activityQuantity = 0;
            updateTotal();
        }
    }

    $scope.back = function() {
        $state.go('app.home');
    }

    $scope.submit = function(dataForm) {
        //Enviar el target con set a targetService
        //console.log(targetObj);
        dataForm.userQuantity = parseInt(dataForm.userQuantity);
        dataForm.weight = parseInt(dataForm.weight);
        //targetObj = dataForm;
        //console.log('DATAFORM');
        //console.log(targetObj);
        targetService.set(dataForm, $scope.$storage);
        $state.go('app.home');
    }

})