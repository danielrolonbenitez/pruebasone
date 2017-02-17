app.factory('model', function($localStorage) {
    var newDate = new Date();
    newDate.setHours(0, 0, 0, 0);
    var dateId = newDate.getTime();
    var service = {
        userData: {
            date: newDate,
            dateId: dateId,
            sunny: true,
            activity: false,
            target: 2000,
            drunk: 0,
            targetOk: false,
            msjShown: false,
            glasses: []
        },

        get: function(theDate, storage) {
            var arrayDates;

            if (storage.userInfo) {
                arrayDates = storage.userInfo.filter(function(el) {
                    return el.dateId == theDate;
                });
                if (arrayDates.length) {
                    console.log('found');
                    return arrayDates[0];
                } else {
                    console.log('not found');

                    //Devuelvo objecto por default
                    newDate = new Date(theDate);
                    newDate.setHours(0, 0, 0, 0);
                    var dateId = theDate;
                    var obj = {
                        date: newDate,
                        dateId: dateId,
                        sunny: false,
                        activity: false,
                        target: 1730,
                        drunk: 0,
                        targetOk: false,
                        msjShown: false,
                        targetModifiedInHome: false,
                        glasses: []
                    }
                    storage.userInfo.push(obj);
                    storage.userInfo.sort(dynamicSort("-dateId"));
                    return obj;
                }
            } else {
                storage.userInfo = [];
            }
        },

        getNoSave: function(theDate, storage) {
            var arrayDates;

            if (storage.userInfo) {
                arrayDates = storage.userInfo.filter(function(el) {
                    return el.dateId == theDate;
                });
                if (arrayDates.length) {
                    console.log('found');
                    return arrayDates[0];
                } else {
                    console.log('not found');
                    return false;
                }
            } else {
                storage.userInfo = [];
            }
        },

        set: function(obj, storage) {
            var arrayDatesIndex = 'notFound';

            if (storage.userInfo) {
                for (var i = storage.userInfo.length - 1; i >= 0; i--) {

                    if (storage.userInfo[i].dateId == obj.dateId) {
                        arrayDatesIndex = i;
                        break;
                    }
                }
                if (arrayDatesIndex != 'notFound') {
                    console.log('lo encontro');
                    storage.userInfo[arrayDatesIndex] = obj;
                } else {
                    console.log('no lo encontro');
                    storage.userInfo.push(obj);
                    storage.userInfo.sort(dynamicSort("-dateId"));
                }
            } else {
                storage.userInfo = [];
                storage.userInfo.push(obj);
                storage.userInfo.sort(dynamicSort("-dateId"));
                console.log('vacio');
            }
        },

        getWeeklyChart: function(year, week, storage) {
            //TO DO
            var today = new Date(),
                revertUser = storage.userInfo.reverse(),
                firstDay = getMonday(today),
                weekArray = [],
                dayDiference = 1000 * 60 * 60 * 24;

            today.setHours(0, 0, 0, 0);
            today = today.getTime();

            for (var i = 0; i < 7; i++) {

                //weekArray[0] = 
            }


            for (i in revertUser) {
                //console.log(revertUser[i]);
            }
        },

        getMonthlyChart: function(year, storage){
            var months = [],
                drunkCount,
                currentMonth,
                currentDate,
                userInfo,
                dateDiff = 1000 * 60 * 60 * 24;

            //Reemplazado
            /*for (var i = 11; i >= 0; i--) {
                drunkCount = 0;
                currentDate = new Date(year, i, 31);
                currentDate.setHours(0, 0, 0);
                currentDate = currentDate.getTime();
                //Recorro los objetos del mes y sumo lo tomado en drunkCount
                for (var j = 0; j < 31; j++) {
                    //Obtengo el objeto de ese dia
                    //console.log(new Date(currentDate));
                    userInfo = this.getNoSave(currentDate, storage);
                    //console.log(userInfo);
                    //Resto un dia de diferencia, para la proxima busqueda
                    currentDate -= dateDiff;
                    if (!userInfo) {
                        //Si es false, no lo encontro
                        drunkCount += 0;
                    } else if (new Date(userInfo.date).getMonth() == i) {
                        //Chequea si esta dentro del mes correcto
                        //sumo el drunk al count
                        drunkCount += userInfo.drunk;
                    } else {
                        //El objeto no es de este mes, paso al mes siguiente;
                        //console.log('break');
                        break;
                    }
                }
                //Asigno al mes correspondiente lo tomado en el mes
                months[i] = drunkCount;
            }*/

            for (var i = 11; i >= 0; i--) {
                //Inicializo array
                months[i] = 0;
            };

            storage.userInfo.forEach(function(element, index){
                //Recorro todo lo almacenado, voy sumando en months
                //El indice indica a que mes pertenece
                var dateElem = new Date(element.date);
                month = dateElem.getMonth();
                if (dateElem.getFullYear() == year) {
                    months[month] += element.drunk;
                }
            });

            console.log(months);
            return months;
        },

        getDialyChart: function(month, year, storage){
            var days = [];

            //Inicializo array con cantidad de dias
            if (month == 0 || month == 2 || month == 4 || month == 6 || month == 7 || month == 9 || month == 11) {
                //Meses de 31 dias
                for (var i = 1; i <= 31; i++) {
                    days[i] = {
                        num: i,
                        drunk: 0,
                        target: 0
                    }
                }
            } else if (month == 3 || month == 5 || month == 8 || month == 10) {
                //Meses de 30 dias
                for (var i = 1; i <= 30; i++) {
                    days[i] = {
                        num: i,
                        drunk: 0,
                        target: 0
                    }
                }
            } else if (leapYear(year)) {
                //Febrero en año biciesto
                for (var i = 1; i <= 29; i++) {
                    days[i] = {
                        num: i,
                        drunk: 0,
                        target: 0
                    }
                }
            } else {
                //Febrero en año no biciesto
                for (var i = 1; i <= 28; i++) {
                    days[i] = {
                        num: i,
                        drunk: 0,
                        target: 0
                    }
                }
            }

            var today = new Date();
            today.setHours(0, 0, 0, 0);
            today = today.getTime();

            storage.userInfo.forEach(function(element, index){
                var dateElem = new Date(element.date);
                if (dateElem.getFullYear() == year && dateElem.getMonth() == month) {
                    
                    days[dateElem.getDate()].num = dateElem.getDate();
                    days[dateElem.getDate()].drunk = element.drunk;
                    days[dateElem.getDate()].isToday = false;
                    
                    if (element.drunk == 0) {
                        days[dateElem.getDate()].target = 0;
                    } else {
                        days[dateElem.getDate()].target = element.target
                    }

                    if (element.dateId == today) {
                        days[dateElem.getDate()].isToday = true;
                    }
                    
                }
            });

            return days;

        }
    }



    function leapYear(year) {
        return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0);
    }

    function getMonday(d) {
        d = new Date(d);
        var day = d.getDay(),
            diff = d.getDate() - day + (day == 0 ? -6 : 1); // adjust when day is sunday
        return new Date(d.setDate(diff));
    }

    function getWeekNumber(d) {
        d = new Date(+d);
        d.setHours(0, 0, 0);
        d.setDate(d.getDate() + 4 - (d.getDay() || 7));
        var yearStart = new Date(d.getFullYear(), 0, 1);
        var weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
        return [d.getFullYear(), weekNo];
    }

    function filter(arr, criteria) {
        return arr.filter(function(obj) {
            return Object.keys(criteria).every(function(c) {
                return obj[c] == criteria[c];
            });
        });
    }

    function dynamicSort(property) {
        var sortOrder = 1;
        if (property[0] === "-") {
            sortOrder = -1;
            property = property.substr(1);
        }
        return function(a, b) {
            var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
            return result * sortOrder;
        }
    }
    return service;
});