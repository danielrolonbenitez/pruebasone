app.factory('notifications', function($localStorage) {

    if (!$localStorage.notifications) {
        $localStorage.notifications = {
            mode: true
        }
    }

    var notification = {

        mode: $localStorage.notifications.mode,

        change: function(val) {
            if (val) {
                notification.mode = true;
            } else {
                notification.mode = false;
            }
        }

    }

    return notification;
});