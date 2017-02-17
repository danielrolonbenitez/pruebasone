var app = angular.module('psaApp', ['ui.router', 'ngMaterial', 'ngAnimate', 'ngAria', 'ngStorage']);

app.factory('appData', function() {
    return {
        tituloSeccion: 'title',
        seccionActual: 'layout',
    }
});

app.factory('activeDate', function() {
    return {
        date: new Date()
    }
});

app.directive('emitLastRepeaterElement', function() {
    return function(scope) {
        if (scope.$last){
            console.log('last');
        }
    }
});

app.config(function($stateProvider, $urlRouterProvider) {
    $stateProvider

    .state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'views/layout.html',
        controller: 'appCtrl'
    })

    .state('app.home', {
        url: '/home',
        views: {
            'layoutContent': {
                templateUrl: 'views/home.html'
            }
        },
        controller: 'homeCtrl'
    })

    /*.state('app.target', {
        url: '/target',
        views: {
            'layoutContent': {
                templateUrl: 'views/target.html'
            }
        }
    })*/

    .state('app.calculator', {
        url: '/calculator',
        views: {
            'layoutContent': {
                templateUrl: 'views/calculator.html'
            }
        }
    })

    .state('app.weeklyCharts', {
        url: '/weeklyCharts',
        views: {
            'layoutContent': {
                templateUrl: 'views/charts.html',
                controller: 'weeklyChartsCtrl'
            }
        }

    })

    .state('app.dialyCharts', {
        url: '/dialyCharts',
        views: {
            'layoutContent': {
                templateUrl: 'views/dialyCharts.html',
                controller: 'dialyChartsCtrl'
            }
        }

    })

    .state('app.monthlyCharts', {
        url: '/monthlyCharts',
        views: {
            'layoutContent': {
                templateUrl: 'views/monthlyCharts.html',
                controller: 'monthlyChartsCtrl'
            }
        }

    })

    .state('app.statistics', {
        url: '/statistics',
        views: {
            'layoutContent': {
                templateUrl: 'views/statistics.html'
            }
        }
    })

    .state('app.settings', {
        url: '/settings',
        views: {
            'layoutContent': {
                templateUrl: 'views/settings.html'
            }
        }
    })

    .state('app.aboutUs', {
        url: '/aboutus',
        views: {
            'layoutContent': {
                templateUrl: 'views/aboutus.html'
            }
        }
    })

    $urlRouterProvider.otherwise('/app/home');
});