app.controller('dialyChartsCtrl', function($scope, $mdDialog, $state, appData, targetService, model, $timeout, $localStorage, $sessionStorage) {

    appData.tituloSeccion = 'Gráfico diario';
    appData.seccionActual = 'dialyCharts';

    $scope.initCharts = function() {
        $scope.service = model;
        //$scope.service.getWeeklyChart(year, week, $localStorage);

        $scope.today = new Date();
        $scope.today.setHours(0, 0, 0, 0);

        $scope.thisMonth = $scope.today.getMonth();
        console.log($scope.thisMonth);

        $scope.year = $scope.today.getFullYear();
        $scope.activeYear = $scope.year; 
        $scope.activeMonth = $scope.thisMonth;

        if ($scope.activeYear > $scope.year ){
            $scope.showNextArrow = false;
        } else if($scope.activeYear == $scope.year && $scope.activeMonth == 11) {
            $scope.showNextArrow = false;
        } else {
            $scope.showNextArrow = true;
        }  

        if ($scope.activeYear <= $scope.year - 1 && $scope.activeMonth <= $scope.thisMonth) {
            $scope.showPrevArrow = false;
        } else {
            $scope.showPrevArrow = true;
        }

        loadChart();
    }

    function loadChart(){
        
        $scope.days = $scope.service.getDialyChart($scope.activeMonth, $scope.activeYear, $localStorage);

        //Calcular el maximo
        var maxVal = 5000;
        /*$scope.days.forEach(function(element, index){
            if (element.val > maxVal) {
                maxVal = element.val;
            }
        });

        if (maxVal < 10000) {
            maxVal = 10000;
        }*/


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
        $scope.days.forEach(function(element, index){
            element.drunkHeight = element.drunk / maxVal * 100;
            element.targetHeight = element.target / maxVal * 100;
        });

        console.log($scope.days);

        $scope.width = $scope.days.length * 24 + 'px';

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

        
        setTimeout(function(){
            var columnToday = document.querySelector('.column.today');
            var fullPosition = getPosition(columnToday);
            var container = document.querySelector('.scroll');
            container.scrollLeft = fullPosition.x - screen.width + 40;
        }, 10)
        

    }

    $scope.changeDate = function(eventDate) {
        changeDate(eventDate);
    }

    function getPosition(element) {
        var xPosition = 0;
        var yPosition = 0;
      
        while(element) {
            xPosition += (element.offsetLeft - element.scrollLeft + element.clientLeft);
            yPosition += (element.offsetTop - element.scrollTop + element.clientTop);
            element = element.offsetParent;
        }
        return { x: xPosition, y: yPosition };
    }

    function changeDate(eventDate) {
        console.log('changeDate');
        if (eventDate == 'prev') {
            if ($scope.activeMonth > 0) {
                $scope.activeMonth -= 1;
            } else {
                $scope.activeMonth = 11;
                $scope.activeYear -= 1;
            }

            if ($scope.activeYear <= $scope.year - 1 && $scope.activeMonth <= $scope.thisMonth) {
                $scope.showPrevArrow = false;
            } else {
                $scope.showPrevArrow = true;
            }

            $scope.showNextArrow = true;

            loadChart();

        } else if(eventDate == 'next'){
            if ($scope.activeMonth < 11) {
                $scope.activeMonth += 1;
            } else {
                $scope.activeMonth = 0;
                $scope.activeYear += 1;
            }

            if ($scope.activeYear > $scope.year ){
                $scope.showNextArrow = false;
            } else if($scope.activeYear == $scope.year && $scope.activeMonth == 11) {
                $scope.showNextArrow = false;
            } else {
                $scope.showNextArrow = true;
            }

            $scope.showPrevArrow = true;

            loadChart();

        }
    }

    


    
})