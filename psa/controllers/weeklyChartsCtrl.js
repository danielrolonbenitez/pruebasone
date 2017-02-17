app.controller('weeklyChartsCtrl', function($scope, $mdDialog, $state, appData, targetService, model, $timeout, $localStorage, $sessionStorage) {

    appData.tituloSeccion = 'Gráfico semanal';
    appData.seccionActual = 'charts';

    $scope.initCharts = function() {
        $scope.service = model;
        //$scope.service.getWeeklyChart(year, week, $localStorage);

        var dayDiference = 1000 * 60 * 60 * 24;

        $scope.today = new Date();
        var today = $scope.today;
        today.setHours(0, 0, 0, 0);

        $scope.activeDate = new Date(today);

        var currentDate = getWeekNumber($scope.activeDate);
        $scope.year = currentDate[0];
        $scope.week = currentDate[1];

        today = today.getTime();

        var firstDay = getMonday($scope.activeDate);
        firstDay = firstDay.getTime();
        //console.log(firstDay);

        var userInfo = $scope.service.getNoSave(firstDay, $localStorage);
        if (!$scope.userInfo) {
            $scope.userInfo = {
                dateId: firstDay,
                sunny: false,
                activity: false,
                target: 0,
                drunk: 0,
                targetOk: false,
                msjShown: false,
                targetModifiedInHome: false,
                glasses: []
            }
        }

        //Inicializo en 0
        $scope.chart = [];
        for (var i = 0; i < 7; i++) {
            $scope.chart[i] = {
                target: {
                    val: 0,
                    height: 0
                },
                drunk: {
                    val: 0,
                    height: 0
                }
            };
            firstDay += dayDiference;
        }

        $timeout(function() {
            //console.log('settimeout');
            firstDay = getMonday(today);
            firstDay = firstDay.getTime();
            for (var i = 0; i < 7; i++) {

                if (firstDay <= today) {
                    //Asigno a userinfo solo si es un dia menor o igual al actual
                    userInfo = $scope.service.getNoSave(firstDay, $localStorage);
                    if (!$scope.userInfo) {
                        $scope.userInfo = {
                            dateId: firstDay,
                            sunny: false,
                            activity: false,
                            target: 0,
                            drunk: 0,
                            targetOk: false,
                            msjShown: false,
                            targetModifiedInHome: false,
                            glasses: []
                        }
                    }
                    $scope.chart[i].target.val = userInfo.target;
                    $scope.chart[i].target.height = userInfo.target * 100 / 5000;
                    $scope.chart[i].drunk.val = userInfo.drunk;
                    $scope.chart[i].drunk.height = userInfo.drunk * 100 / 5000;
                } else {
                    //Si es un dia posterior al actual, en userInfo queda asignado
                    //el objeto del ultimo dia seteado
                    $scope.chart[i].target.val = userInfo.target;
                    $scope.chart[i].target.height = userInfo.target * 100 / 5000;
                    $scope.chart[i].drunk.val = 0;
                    $scope.chart[i].drunk.height = 0;
                }

                firstDay += dayDiference;
            };
        }, 100);

        //console.log($scope.chart);


        checkToday();

    }

    $scope.changeDate = function(eventDate) {
        changeDate(eventDate);
    }

    function changeDate(eventDate) {
        var dayDiference = 1000 * 60 * 60 * 24,
            newWeek,
            dateMilis;

        /* Si es prev resta un día, si es next suma un día */
        if (eventDate == 'next') {
            newWeek = $scope.activeDate.getTime() + (dayDiference * 7);
        } else if (eventDate == 'prev') {
            newWeek = $scope.activeDate.getTime() - (dayDiference * 7);
        } else if (eventDate == 'picker') {
            return false;
        }

        changeChart(newWeek);
        checkToday(newWeek);
    }

    function changeChart(day) {
        var dayDiference = 1000 * 60 * 60 * 24;
        day = new Date(day);
        $scope.activeDate = new Date(day);

        currentDate = getWeekNumber($scope.activeDate);
        $scope.year = currentDate[0];
        $scope.week = currentDate[1];

        day = day.getTime();

        var firstDay = getMonday($scope.activeDate);
        firstDay = firstDay.getTime();
        //console.log(firstDay);

        var userInfo = $scope.service.getNoSave(firstDay, $localStorage);
        if (!$scope.userInfo) {
            $scope.userInfo = {
                dateId: firstDay,
                sunny: false,
                activity: false,
                target: 0,
                drunk: 0,
                targetOk: false,
                msjShown: false,
                targetModifiedInHome: false,
                glasses: []
            }
        }

        //console.log('settimeout');
        firstDay = getMonday(day);
        firstDay = firstDay.getTime();

        var today = $scope.today;
        today.setHours(0, 0, 0, 0);
        today = today.getTime();

        for (var i = 0; i < 7; i++) {

            if (firstDay <= today) {
                //console.log('if');
                console.log(firstDay);
                console.log(day);
                //Asigno a userinfo solo si es un dia menor o igual al actual
                userInfo = $scope.service.getNoSave(firstDay, $localStorage);
                if (!$scope.userInfo) {
                    $scope.userInfo = {
                        dateId: firstDay,
                        sunny: false,
                        activity: false,
                        target: 0,
                        drunk: 0,
                        targetOk: false,
                        msjShown: false,
                        targetModifiedInHome: false,
                        glasses: []
                    }
                }
                $scope.chart[i].target.val = userInfo.target;
                $scope.chart[i].target.height = userInfo.target * 100 / 5000;
                $scope.chart[i].drunk.val = userInfo.drunk;
                $scope.chart[i].drunk.height = userInfo.drunk * 100 / 5000;
            } else {
                //Si es un dia posterior al actual, en userInfo queda asignado
                //el objeto del ultimo dia seteado
                $scope.chart[i].target.val = userInfo.target;
                $scope.chart[i].target.height = userInfo.target * 100 / 5000;
                $scope.chart[i].drunk.val = 0;
                $scope.chart[i].drunk.height = 0;
            }

            firstDay += dayDiference;
        }

    }



    function getMonday(d) {
        d = new Date(d);
        var day = d.getDay(),
            diff = d.getDate() - day + (day == 0 ? -6 : 1); // adjust when day is sunday
        return new Date(d.setDate(diff));
    }

    function getWeekNumber(d) {
        // Copy date so don't modify original
        d = new Date(+d);
        d.setHours(0, 0, 0);
        // Set to nearest Thursday: current date + 4 - current day number
        // Make Sunday's day number 7
        d.setDate(d.getDate() + 4 - (d.getDay() || 7));
        // Get first day of year
        var yearStart = new Date(d.getFullYear(), 0, 1);
        // Calculate full weeks to nearest Thursday
        var weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
        // Return array of year and week number
        return [d.getFullYear(), weekNo];
    }

    function checkToday() {
        var milActiveDate = new Date($scope.activeDate),
            milToday = new Date($scope.today);

        milActiveDate.setHours(0, 0, 0, 0);
        milActiveDate = milActiveDate.getTime();

        milToday.setHours(0, 0, 0, 0);
        milToday = milToday.getTime();

        if (milActiveDate == milToday) {
            $scope.showNextArrow = false;
            $scope.isToday = true;
            return true;
        } else {
            $scope.showNextArrow = true;
            $scope.isToday = false;
            return false;
        }
    }
})