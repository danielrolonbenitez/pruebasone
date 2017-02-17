app.controller('homeCtrl', function($scope, $location, $state, $mdDialog, appData, activeDate, model, notifications, targetService, $localStorage, $sessionStorage) {

    appData.tituloSeccion = 'AGUA PURA PSA';
    appData.seccionActual = 'home';

    $scope.initAddNew = function() {
        //Inicializo la vista que agrega vasos
        $scope.activeDate = new Date(activeDate.date);
        //console.log($scope.activeDate);
        $scope.activeDate.setHours(0, 0, 0, 0);

        if (!$localStorage.userInfo || !$localStorage.userInfo.length) {
            $localStorage.userInfo = [];
        }
        $scope.$storage = $localStorage;

        $scope.service = model;

        if (!$localStorage.notifications) {
            $localStorage.notifications.mode = true;
        };

        //$scope.userInfo = $scope.service.get($scope.activeDate.getTime(), $scope.$storage);
        //console.log($scope.userInfo);

        $scope.glassTypes = [{
            type: 1,
            capacitance: 250,
            icon: 'ic_vasolargo_home.png',
            iconSelect: 'ic_vasolargo_select.png'
        }, {
            type: 2,
            capacitance: 200,
            icon: 'ic_taza2_home.png',
            iconSelect: 'ic_taza2_select.png'
        }, {
            type: 3,
            capacitance: 180,
            icon: 'ic_taza_home.png',
            iconSelect: 'ic_taza_select.png'
        }, {
            type: 4,
            capacitance: 600,
            icon: 'ic_botella2_home.png',
            iconSelect: 'ic_botella2_select.png'
        }, {
            type: 5,
            capacitance: 750,
            icon: 'ic_botella_home.png',
            iconSelect: 'ic_botella_select.png'
        }, {
            type: 6,
            capacitance: 150,
            icon: 'ic_copa_home.png',
            iconSelect: 'ic_copa_select.png'
        }, ]

    }

    $scope.initHome = function() {
        var a = $mdDialog.cancel();
        //console.log(a.$$state.status);
        $location.replace();
        //comprobacion por si no existe localStorage
        if (!$localStorage.userInfo || !$localStorage.userInfo.length) {
            $localStorage.userInfo = [];
        }
        $scope.$storage = $localStorage;

        $scope.today = new Date();
        $scope.today.setHours(0, 0, 0, 0);

        $scope.activeDate = new Date(activeDate.date);
        //console.log($scope.activeDate);
        $scope.activeDate.setHours(0, 0, 0, 0);

        $scope.service = model;
        $scope.userInfo = $scope.service.get($scope.today.getTime(), $scope.$storage);
        //console.log($scope.userInfo);
        //console.log($scope.userInfo.date);

        //Seteo las fechas
        var dateMilis = new Date($scope.userInfo.dateId);
        $scope.dateSelected = dateMilis.getUTCDate() + ' de ' + getMonth(dateMilis.getUTCMonth()) + ' ' + dateMilis.getUTCFullYear();
        $scope.activeDate = $scope.userInfo.date;
        checkToday();

        //Si el target cambio en la otra vista, lo actualiza.
        //Solo si es la fecha actual
        if ($scope.isToday) {
            $scope.dataTarget = getTarget();

            if ($scope.userInfo.target != $scope.dataTarget.total) {
                //console.log('el target cambió');
                //console.log($scope.dataTarget.total);


                //Si el target se cambio desde el home, se mantiene
                //Si se modifico desde calculator, el target se actualiza
                if (!$scope.userInfo.targetModifiedInHome) {
                    if (typeof $scope.dataTarget.total == 'undefined') {
                        //console.log('entre al if');
                        $scope.userInfo.target = $scope.dataTarget.target;
                    } else {
                        //console.log('entre al else');
                        $scope.userInfo.target = $scope.dataTarget.total;
                    }

                    $scope.userInfo.sunny = $scope.dataTarget.sunny;
                    $scope.userInfo.activity = $scope.dataTarget.activity;
                }

                if ($scope.userInfo.drunk < $scope.dataTarget.total) {
                    $scope.userInfo.targetOk = false;
                    $scope.userInfo.msjShown = false;
                    //console.log('se perdio el objetivo');
                }

                //guardo el objeto con el target modificado
                $scope.service.set($scope.userInfo, $scope.$storage);
            } else {
                //console.log('el target no cambio');
            }
        }

        //Seteo la categoria del target
        setCategoryTarget();

        //Chequeo si no existe configuracion de notificaciones en 
        //localStorage, por defecto estan activadas
        if (!$localStorage.notifications) {
            $localStorage.notifications.mode = true;
        }

        if (typeof $localStorage.firstTime == 'undefined') {
            //Si es la primera vez que entra, setea la variable firstTime
            //en localstorage como true
            $localStorage.firstTime = true;
            $state.go('app.calculator');
        }

        if ($localStorage.firstTime) {
            //La proxima vez que entre, si llega aca es porque no es 
            //la primera vez. Seteo firstTime como false
            $localStorage.firstTime = false;
        }

        // Inicializar el nuevo datepicker
        initPicker();

        verifyTarget();
    }

    function initPicker(){
        $scope.currentDate = new Date($scope.activeDate);
        //console.log($scope.currentDate);
        $scope.minDate = new Date(
            $scope.today.getFullYear(),
            $scope.today.getMonth() - 12
            );

        $scope.maxDate = new Date($scope.today);
    }

    $scope.showConfirm = function(ev, index) {
        // Appending dialog to document.body to cover sidenav in docs app
        var confirm = $mdDialog.confirm()
            .title('Borrar entrada')
            .content('¿Estás seguro que queres borrar esta entrada?')
            .targetEvent(ev)
            .ok('ACEPTAR')
            .cancel('CANCELAR');
        $mdDialog.show(confirm).then(function() {
            //console.log('aceptar');
            $scope.delete(index);
        }, function() {
            //console.log('cancelar');
        });
    };

    function DialogController($scope, $mdDialog, items) {
        $scope.hide = function() {
            $mdDialog.hide();
        };
        $scope.cancel = function() {
            $mdDialog.cancel();
        };
        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };
        $scope.target = items;
    }

    function DialogControllerList($scope, $mdDialog, items, userInfo) {
        $scope.hide = function() {
            //console.log('hide');
            //console.log($mdDialog.hide());
            //$mdDialog.hide();
        };
        $scope.cancel = function() {
            //console.log('cancel');
            //console.log($mdDialog.cancel());
            //$mdDialog.cancel();
        };
        $scope.answer = function(answer) {
            //console.log('answer');
            var a = $mdDialog.hide(answer);
            //console.log(a.$$state.status);
            //$mdDialog.hide(answer);
        };
        $scope.target = items;
        $scope.userInfo = userInfo;
    }
    $scope.showList = function(ev) {
        $mdDialog.show({
            controller: DialogControllerList,
            templateUrl: 'views/_add-new.html',
            parent: document.getElementById('#home'),
            targetEvent: ev,
            clickOutsideToClose: true,
            locals: {
                items: $scope.userInfo.target,
                userInfo: $scope.userInfo
            }
        })
            .then(function(answer) {}, function() {});
    };

    $scope.delete = function(index) {
        //console.log('delete ' + index);
        $scope.userInfo.glasses.splice(index, 1);
        refreshDrunk();
        verifyTarget();
    }

    $scope.addNewGlass = function(item) {
        var newGlass,
            hours,
            minutes,
            now,
            amOrPm;

        //console.log(item);
        //Oculto el dialog
        $mdDialog.hide();

        now = new Date();
        minutes = now.getMinutes('mm');

        //Condicion para que si los minutos son menores a 10 agrega un 0 adelante
        if (minutes < 10) {
            minutes = '0' + minutes;
        }
        hours = now.getHours();
        //amOrPm = (hours >= 12 ? 'PM' : 'AM');
        //now = hours + ':' + minutes + ' ' + amOrPm;
        now = hours + ':' + minutes;

        newGlass = {
            type: item.type,
            capacitance: item.capacitance,
            hour: now
        };

        //console.log(newGlass);
        //console.log($scope.userInfo);

        $scope.userInfo.glasses.push(newGlass);

        //console.log($scope.userInfo.glasses);

        refreshDrunk();

        //checkToday();

        //Defino de nuevo isToday en este controlador
        $scope.isToday = true;
        verifyTarget();

        $scope.dataTarget = getTarget();

        $scope.service.set($scope.userInfo, $scope.$storage);
        //$localStorage.userData[$scope.userInfo.date] = $scope.userInfo;

        //console.log($localStorage.userData[$scope.userInfo.date]);
    }

    $scope.progressed = function() {
        var progressed = $scope.userInfo.drunk * 100 / $scope.userInfo.target;
        //progressed += '%';
        //console.log('progressed:' + progressed);

        return progressed;
    }

    function refreshDrunk() {
        var newDrunk = 0;
        for (var i = $scope.userInfo.glasses.length - 1; i >= 0; i--) {
            newDrunk += $scope.userInfo.glasses[i].capacitance;
        };
        $scope.userInfo.drunk = newDrunk;

    }

    function verifyTarget() {
        //console.log('notifications ' + $scope.$storage.notifications.mode);

        if ($scope.userInfo.drunk >= $scope.userInfo.target) {
            $scope.userInfo.targetOk = true;
            //console.log('targetOk ' + $scope.userInfo.targetOk);
        } else {
            $scope.userInfo.targetOk = false;
            $scope.userInfo.msjShown = false;
            //console.log('targetOk ' + $scope.userInfo.targetOk);
        }

        var addNewButton = document.querySelector('.addNew');
        var className = 'show';
        if ($scope.userInfo.targetOk) {
            if ($scope.$storage.notifications.mode && !($scope.userInfo.msjShown)) {
                setTimeout(function() {
                    $mdDialog.show({
                        controller: DialogController,
                        templateUrl: 'views/_congratulations.html',
                        parent: angular.element(document.body),
                        //targetEvent: ev,
                        clickOutsideToClose: true,
                        locals: {
                            items: $scope.userInfo.target
                        }
                    });
                }, 1000);
                //console.log('msjShown ' + $scope.userInfo.msjShown);
                $scope.userInfo.msjShown = true;
                //console.log('msjShown ' + $scope.userInfo.msjShown);
            }
            addNewButton.classList.remove(className);
            $scope.showAddNewButton = false;
            
        } else {
            if ($scope.isToday) {
                addNewButton.classList.add(className);
                $scope.showAddNewButton = true;
            } else {
                addNewButton.classList.remove(className);
                $scope.showAddNewButton = false;
            }

        }
    }

    $scope.getIconHome = function(type) {
        var glass = filter($scope.glassTypes, {
            type: type
        })[0];

        return glass.icon;
    }

    function filter(arr, criteria) {
        return arr.filter(function(obj) {
            return Object.keys(criteria).every(function(c) {
                return obj[c] == criteria[c];
            });
        });
    }

    function getMonth(monthNumber) {
        var months = [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
        ];

        return months[monthNumber];
    }

    $scope.changeDate = function(eventDate) {
        changeDate(eventDate);
    }

    function changeDate(eventDate) {
        //Funcion que se dispara al cambiar la fecha
        //Trae la informacion del user de esa fecha
        var dayDiference = 1000 * 60 * 60 * 24,
            newDate,
            dateMilis;

        /* Si es prev resta un día, si es next suma un día */
        if (eventDate == 'next') {
            newDate = $scope.userInfo.dateId + dayDiference;
        } else if (eventDate == 'prev') {
            newDate = $scope.userInfo.dateId - dayDiference;
        } else if (eventDate == 'picker') {
            newDate = $scope.currentDate.getTime();
            //console.log('PICKER');
            //console.log(newDate);
            //return false;
        }

        //console.log('newDate ' + new Date(newDate));
        //console.log('old date ' + new Date($scope.userInfo.dateId));

        $scope.userInfo = $scope.service.getNoSave(newDate, $scope.$storage);
        if (!$scope.userInfo) {
            $scope.userInfo = {
                dateId: newDate,
                sunny: false,
                activity: false,
                target: 1730,
                drunk: 0,
                targetOk: false,
                msjShown: false,
                targetModifiedInHome: false,
                glasses: []
            }
        }

        //console.log('new UserInfo');
        //console.log($scope.userInfo);

        dateMilis = new Date($scope.userInfo.dateId);
        $scope.dateSelected = dateMilis.getUTCDate() + ' de ' + getMonth(dateMilis.getUTCMonth()) + ' ' + dateMilis.getUTCFullYear();
        $scope.currentDate = dateMilis;

        $scope.activeDate = $scope.userInfo.date;
        activeDate.date = $scope.activeDate;

        setCategoryTarget();

        checkToday();
        verifyTarget();
    }

    function checkToday() {
        //Determina si la fecha seleccionada es la fecha actual
        var milActiveDate = new Date($scope.activeDate),
            milToday = new Date($scope.today);

        milActiveDate = milActiveDate.getTime();
        milToday = milToday.getTime();

        if (milActiveDate == milToday) {
            $scope.dateSelected = 'Hoy';
            $scope.showNextArrow = false;
            $scope.isToday = true;
            $scope.showAddNewButton = true;
            return true;
        } else {
            $scope.showNextArrow = true;
            $scope.isToday = false;
            $scope.showAddNewButton = false;
            return false;
        }
    }

    function getTarget() {
        if (typeof $localStorage.currentTarget == 'undefined') {
            //Target por default
            //console.log('Entro al target por default');
            return $localStorage.currentTarget = {
                userQuantity: 1730,
                target: 1730,
                sunny: 0,
                activity: 0,
                sex: 1,
                weight: 0
            };
        }
        //$scope.$storage = $localStorage;

        return targetService.get($scope.$storage);
    }

    function setCategoryTarget() {
        //Indoca que caracteristicas seteadas tiene el target
        $scope.targetCategory = 'Normal';
        if ($scope.userInfo.sunny) {
            $scope.targetCategory = 'Día soleado ';
            if ($scope.userInfo.activity) {
                $scope.targetCategory += '+ Actividad física ';
            }
        } else if ($scope.userInfo.activity) {
            $scope.targetCategory = 'Actividad física ';
        }
    }

    $scope.changeActivity = function() {
        //Al tocar el icono de actividad se dispara, lo cambia
        //y lo guarda
        if ($scope.isToday) {
            if ($scope.userInfo.activity) {
                $scope.userInfo.activity = false;
                $scope.userInfo.target = $scope.userInfo.target - 450;
            } else {
                $scope.userInfo.activity = true;
                $scope.userInfo.target = $scope.userInfo.target + 450;
            }

            //Guardo los cambios
            $scope.userInfo.targetModifiedInHome = true;
            $scope.service.set($scope.userInfo, $scope.$storage);
            verifyTarget();
        }
    }

    $scope.changeSunny = function() {
        //Al tocar el icono de sunny se dispara, lo cambia
        //y lo guarda
        if ($scope.isToday) {
            if ($scope.userInfo.sunny) {
                $scope.userInfo.sunny = false;
                $scope.userInfo.target = $scope.userInfo.target - 300;
            } else {
                $scope.userInfo.sunny = true;
                $scope.userInfo.target = $scope.userInfo.target + 300;
            }

            //Guardo los cambios
            $scope.userInfo.targetModifiedInHome = true;
            $scope.service.set($scope.userInfo, $scope.$storage);
            verifyTarget();
        }
    }

    $scope.showGoalComplete = function(){
        return ($scope.isToday && $scope.userInfo.targetOk);
    }

    document.addEventListener("backbutton", onBackKeyDown, false);

    function onBackKeyDown() {
        if(angular.element(document).find('md-dialog').length > 0) {
            event.preventDefault(); // Prevent route from changing
            $mdDialog.cancel();  // Cancel the active dialog
        } else {
            history.back();
            $location.replace();
        }
    }

    $scope.glassTypes = [{
        type: 1,
        capacitance: 250,
        icon: 'ic_vasolargo_home.png',
        iconSelect: 'ic_vasolargo_select.png'
    }, {
        type: 2,
        capacitance: 200,
        icon: 'ic_taza2_home.png',
        iconSelect: 'ic_taza2_select.png'
    }, {
        type: 3,
        capacitance: 180,
        icon: 'ic_taza_home.png',
        iconSelect: 'ic_taza_select.png'
    }, {
        type: 4,
        capacitance: 600,
        icon: 'ic_botella2_home.png',
        iconSelect: 'ic_botella2_select.png'
    }, {
        type: 5,
        capacitance: 750,
        icon: 'ic_botella_home.png',
        iconSelect: 'ic_botella_select.png'
    }, {
        type: 6,
        capacitance: 150,
        icon: 'ic_copa_home.png',
        iconSelect: 'ic_copa_select.png'
    }, ]

})