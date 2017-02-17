app.factory('targetService', function($localStorage) {
    var targetService = {
        currentTarget: {
            userQuantity: 1730,
            target: 1730,
            total: 1730,
            sunny: false,
            activity: false,
            sex: 0,
            weight: 0
        },

        get: function(storage) {
            //Se llama cuando ingresa al formulario
            //if (storage.currentTarget == 'undefined') {

            //}
            console.log('get');
            console.log(storage.currentTarget);
            return storage.currentTarget;
        },

        set: function(obj, storage) {
            //Se llama cuando se envia el formulario
            storage.currentTarget.userQuantity = obj.userQuantity;
            storage.currentTarget.sunny = obj.sunny;
            storage.currentTarget.activity = obj.activity;
            storage.currentTarget.weight = obj.weight;
            storage.currentTarget.sex = obj.sex;
            storage.currentTarget.target = obj.total;
        }
    }
    return targetService;
});