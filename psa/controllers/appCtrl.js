app.controller('appCtrl', function($scope, $location, $rootScope, $timeout, $mdSidenav, $log, $state, appData, $mdDialog, $localStorage, $sessionStorage) {
    $scope.toggleLeft = buildToggler('left');
    $scope.isOpenLeft = function() {
        return $mdSidenav('left').isOpen();
    };
    /**
     * Supplies a function that will continue to operate until the
     * time is up.
     */
    $scope.appData = appData;
    appData.tituloSeccion = 'title';

    $scope.msjShowed = false;

    function debounce(func, wait, context) {
        var timer;
        return function debounced() {
            var context = $scope,
                args = Array.prototype.slice.call(arguments);
            $timeout.cancel(timer);
            timer = $timeout(function() {
                timer = undefined;
                func.apply(context, args);
            }, wait || 10);
        };
    }
    /**
     * Build handler to open/close a SideNav; when animation finishes
     * report completion in console
     */
    function buildDelayedToggler(navID) {
        return debounce(function() {
            $mdSidenav(navID)
                .toggle()
                .then(function() {
                    //$log.debug("toggle " + navID + " is done");
                });
        }, 200);
    }

    function buildToggler(navID) {
        return function() {
            $mdSidenav(navID)
                .toggle()
                .then(function() {
                    $log.debug("toggle " + navID + " is done");
                });
        }
    }

    $scope.back = function(prev) {
        if ($scope.appData.seccionActual == 'dialyCharts') {
            $state.go('app.home');
            $location.replace();
        } else if ($scope.appData.seccionActual == 'charts') {
            $state.go('app.home');
            $location.replace();
        } else if ($scope.appData.seccionActual == 'monthlyCharts') {
            $state.go('app.home');
            $location.replace();
        } else {
            history.back();
            $location.replace();
        }
    }

    function DialogController($scope, $mdDialog) {
        $scope.hide = function() {
            $mdDialog.hide();
        };
        $scope.cancel = function() {
            $mdDialog.cancel();
        };
        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };
    }

    $scope.close = function() {
        $mdSidenav('left').close()
            .then(function() {
                $log.debug("close LEFT is done");
            });
    };

})

.controller('leftCtrl', function($scope, $timeout, $mdSidenav, $log) {

})