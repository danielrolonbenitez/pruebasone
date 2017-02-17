app.directive('setSize', function() {
    /* setea la mitad de width y height original para visualizacion correcta
    en pantallas retina */
    return {
        restrict: 'A',
        link: function(scope, elem, attr) {
            elem.on('load', function() {
                var w = $(this).width(),
                    h = $(this).height();

                //TODO

            });
        }
    };
});