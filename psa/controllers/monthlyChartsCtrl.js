app.controller('monthlyChartsCtrl', function($scope, $mdDialog, $state, appData, targetService, model, $timeout, $localStorage, $sessionStorage) {

    appData.tituloSeccion = 'Gráfico mensual';
    appData.seccionActual = 'monthlyCharts';

    $scope.initCharts = function() {
        $scope.service = model;
        //$scope.service.getWeeklyChart(year, week, $localStorage);

        $scope.today = new Date();
        $scope.today.setHours(0, 0, 0, 0);

        $scope.thisMonth = $scope.today.getMonth();
        console.log($scope.thisMonth);

        $scope.year = $scope.today.getFullYear();
        $scope.activeYear = $scope.year; 

        $scope.showPrevArrow = false;
        $scope.showNextArrow = false;  

        loadChart();
    }

    function loadChart(){
        
        $scope.months = $scope.service.getMonthlyChart($scope.activeYear, $localStorage);

        $scope.newMonths = [];

        switch($scope.thisMonth){
            case 0:
                console.log('statement 0');
                $scope.newMonths = [{
                    num: 1,
                    val: $scope.months[$scope.thisMonth]
                },
                {
                    num: 2,
                    val: $scope.months[$scope.thisMonth + 1]
                },
                {
                    num: 3,
                    val: $scope.months[$scope.thisMonth + 2]
                }];
                break;
            case 1:
                console.log('statement 1');
                $scope.newMonths = [{
                    num: 1,
                    val: $scope.months[$scope.thisMonth - 1]
                },
                {
                    num: 2,
                    val: $scope.months[$scope.thisMonth]
                },
                {
                    num: 3,
                    val: $scope.months[$scope.thisMonth + 1]
                }];
                break;
            
            default:
                console.log('statement default');
                $scope.newMonths = [{
                    num: $scope.thisMonth - 1,
                    val: $scope.months[$scope.thisMonth - 2]
                },
                {
                    num: $scope.thisMonth,
                    val: $scope.months[$scope.thisMonth - 1]
                },
                {
                    num: $scope.thisMonth + 1,
                    val: $scope.months[$scope.thisMonth]
                }];
                break;
        }

        console.log($scope.newMonths);

        //Calcular el maximo
        var maxVal = 0;
        $scope.newMonths.forEach(function(element, index){
            if (element.val > maxVal) {
                maxVal = element.val;
            }
        });

        if (maxVal < 10000) {
            maxVal = 10000;
        }


        //Dividir el maximo en 10 valores redondos para el grafico
        if (maxVal >= 100000) {
            maxVal = maxVal / 10000;
            maxVal = Math.floor(maxVal);
            maxVal = maxVal * 10000; 
        } else {
            maxVal = maxVal / 1000;
            maxVal = Math.floor(maxVal);
            maxVal = maxVal * 1000; 
        }


        $scope.ejeY = [];
        for (var i = 1; i <= 10; i++) {
            $scope.ejeY[i] = maxVal / 10 * i;   
        }
        $scope.ejeY.reverse();
        //console.log($scope.ejeY);

        //Calcular alturas
        //$scope.monthHeight = [];
        $scope.newMonths.forEach(function(element, index){
            element.height = element.val / maxVal * 100;
        });

        //$scope.width = $scope.monthHeight.length * 96 + 'px';

        //Chequear flechas
        /*if ($scope.activeYear < $scope.year) {
            $scope.showPrevArrow = false;
        } else {
            $scope.showPrevArrow = true;
        }
        if ($scope.activeYear >= $scope.year) {
            $scope.showNextArrow = false;
        } else {
            $scope.showNextArrow = true;
        }*/
    }

    $scope.changeDate = function(eventDate) {
        changeDate(eventDate);
    }

    function changeDate(eventDate) {
        if (eventDate == 'prev') {
            //if ($scope.activeYear <= $scope.year) {
            //    $scope.showPrevArrow = false;
            //    return false;
            //} else {
                $scope.activeYear -= 1;
                loadChart();
            //}
        } else if(eventDate == 'next'){
            //if ($scope.activeYear >= $scope.year) {
            //    $scope.showNextArrow = false;
            //    return false;
            //} else {
                $scope.activeYear += 1;
                loadChart();
            //}

        }
    }

    


    
})