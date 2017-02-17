app.controller('statisticsCtrl', function($scope, $state, $mdDialog, appData, model, $localStorage, $sessionStorage) {

    appData.tituloSeccion = 'Estadísticas';
    appData.seccionActual = 'statistics';

    $scope.initStatistics = function() {
        if (!$localStorage.userInfo || !$localStorage.userInfo.length) {
            $localStorage.userInfo = [];
        }

        $scope.$storage = $localStorage;

        $scope.allData = $scope.$storage.userInfo;

        $scope.currentDate = new Date();
        $scope.currentDate.setHours(0, 0, 0, 0);

        $scope.resume = setResume();

        $scope.statisticsList = setStatisticsList();

    }

    function setResume() {
        var entriesCount = 0,
            firstDate = 0,
            minDate = $scope.currentDate.getTime(),
            dateDiff = 1000 * 60 * 60 * 24,
            firstEntry,
            totalLiter = 0;

        for (i in $scope.allData) {
            //get glasses length
            entriesCount += $scope.allData[i].glasses.length;

            //get first day
            if ($scope.allData[i].glasses.length) {
                if ($scope.allData[i].dateId < minDate) {
                    minDate = $scope.allData[i].dateId;
                }
            }

            //get total L
            for (j in $scope.allData[i].glasses) {
                totalLiter += $scope.allData[i].glasses[j].capacitance;
            }
        }

        firstEntry = ($scope.currentDate.getTime() - minDate) / dateDiff;

        totalLiter = totalLiter / 1000;

        return resume = {
            entries: entriesCount,
            firstEntry: firstEntry,
            totalLiters: totalLiter
        }
    }

    function setStatisticsList() {
        var count7 = 0,
            count14 = 0,
            count30 = 0,
            count60 = 0,
            days7 = 0,
            days14 = 0,
            days30 = 0,
            days60 = 0,
            day0Id = 0,
            dateDiff = 1000 * 60 * 60 * 24,
            currentDate = $scope.currentDate.getTime();

        for (i in $scope.allData) {
            if ($scope.allData[i].dateId >= currentDate - dateDiff * 7) {
                //console.log('7 dias ' + i);
                if ($scope.allData[i].glasses.length) {
                    for (j in $scope.allData[i].glasses) {
                        count7 += $scope.allData[i].glasses[j].capacitance;
                    }
                }
            } else if ($scope.allData[i].dateId >= currentDate - dateDiff * 14) {
                //console.log('14 dias ' + i);
                for (j in $scope.allData[i].glasses) {
                    count14 += $scope.allData[i].glasses[j].capacitance;
                }
            } else if ($scope.allData[i].dateId >= currentDate - dateDiff * 30) {
                //console.log('30 dias ' + i);
                for (j in $scope.allData[i].glasses) {
                    count30 += $scope.allData[i].glasses[j].capacitance;
                }
            } else if ($scope.allData[i].dateId >= currentDate - dateDiff * 60) {
                //console.log('60 dias ' + i);
                for (j in $scope.allData[i].glasses) {
                    count60 += $scope.allData[i].glasses[j].capacitance;
                }
            }
        }

        days7 = count7 / (7 * 1000);
        days14 = (count7 + count14) / (14 * 1000);
        days30 = (count7 + count14 + count30) / (30 * 1000)
        days60 = (count7 + count14 + count30 + count60) / (60 * 1000)

        return statisticsList = [{
            description: '7 días',
            value: days7
        }, {
            description: '14 días',
            value: days14
        }, {
            description: '30 días',
            value: days30
        }, {
            description: '2 meses',
            value: days60
        }];
    }

})