var FUNCTION = window.FUNCTION || {}; //global namespace for YOUR PROJECT, Please change PROJECT to your project name
var localtion_url = location.protocol;
var root = localtion_url+"//"+location.host;

(function($) {
    FUNCTION.Global = {
        init: function() { //initialization code goes here
            this.initFormElements();
        },

        initFormElements: function() {
            $(document).on('click', '.login-btn', function(e) {
                e.preventDefault();
                var _this = $(this);

                FB.login(function (response) {
                    if (response.authResponse) {
                        var access_token = response.authResponse.accessToken;

                        var url = root + '/page/profile';
                        var data = {
                            access_token: access_token
                        };
                        var res = Util.getPostContent(url, data);

                        console.log(res);
                    } else {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, { scope: 'email, publish_actions' });


                return false;

            });

        },

        doLoginFBFunction : function(response){
            console.log(response.status);
        }


    };
})(jQuery);

$(document).ready(function($) {
    FUNCTION.Global.init();
});