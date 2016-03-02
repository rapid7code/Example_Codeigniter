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

                        if(res.E_CODE == 0 ){
                            window.location.href = '/hoa-lan-toa-sac.html';
                        }

                    } else {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, { scope: 'email, publish_actions' });


                return false;

            });

            $(document).on('click', '.update-btn', function(e) {
                e.preventDefault();
                var _this = $(this);
                var phone = $('#phone').val();

                if( phone == '' ){
                    alert('Vui lòng nhập số điện thoại để nhận thông báo khi bạn là khách mời may mắn từ chương trình!');
                    return false;
                }

                if( phone.length < 8 || phone.length > 12 ){
                    alert('Số điện thoại phải từ 8 đến 12 ký tự.');
                    return false;
                }

                if( !Validator.isValidPhone(phone) ){
                    alert('Số điện thoại không đúng định dạng');
                    return false;
                }

                var url = root + '/page/update_phone';
                var data = {
                    phone: phone
                };
                var res = Util.getPostContent(url, data);
                if(res.E_CODE == 0 ) {
                    $('.phone-text').css('display', 'none');
                    $('.col-one-half').addClass('full-width');//full-width
                } else {
                    alert(res.E_MSG);
                }
            });

            $(document).on('click', '.share-btn', function(e) {
                e.preventDefault();
                var _this = $(this);
                var phone = $('#phone').val();

                if( phone == '' ){
                    alert('Vui lòng nhập số điện thoại để nhận thông báo khi bạn là khách mời may mắn từ chương trình!');
                    return false;
                }

                if( phone.length < 8 || phone.length > 12 ){
                    alert('Số điện thoại phải từ 8 đến 12 ký tự.');
                    return false;
                }

                if( !Validator.isValidPhone(phone) ){
                    alert('Số điện thoại không đúng định dạng');
                    return false;
                }

                var url = root + '/page/update_phone';
                var data = {
                    phone: phone
                };
                var res = Util.getPostContent(url, data);

                if(res.E_CODE == 0 ) {
                    FB.ui({
                            method		: 'feed',
                            link		: root,
                            picture		: res.URL_SHARE,
                            name		: 'Tham dự sự kiện Dove Ngôi Nhà Hoa Lan Tỏa Sắc',
                            caption		: '',
                            description	: 'Chia sẻ 1 đóa lan xanh tỏa sắc MANG TÊN BẠN để nhận vé dự sự kiện VIP với các đặc quyền hấp dẫn vào ngày 05 & 06/03/16 tại Hồ Bán Nguyệt Q7, HCM. Khám phá ngay!'
                        }, function(response){
                            /*if(response){
                                window.location.href = '/thankyou.html';
                            }*/
                            return false;

                        }
                    );
                } else {
                    alert(res.E_MSG);
                }

            });
        },

        doLoginFBFunction : function(response){
            console.log(response.status);
        },

        allowInputPhone : function (evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }


    };
})(jQuery);

$(document).ready(function($) {
    FUNCTION.Global.init();
});