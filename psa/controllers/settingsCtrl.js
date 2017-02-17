app.controller('settingsCtrl', function($scope, $mdDialog, $state, appData, notifications, $localStorage, $sessionStorage) {

    appData.tituloSeccion = 'Configuraciones';
    appData.seccionActual = 'settings'

    $scope.notifications = notifications;

    $scope.message = 'false';
    $scope.change = function() {
        $localStorage.notifications = notifications;
        console.log(notifications.mode);
    };

    cordova.getAppVersion(function (version) {
	    $scope.versionCode = version;
	});

})