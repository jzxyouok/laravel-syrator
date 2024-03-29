var Login = function () {
return {
    init: function () {
    	
       $('.login-form').validate({
            errorElement: 'label',
            errorClass: 'help-inline',
            focusInvalid: false,
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                remember: {
                    required: false
                }
            },

            messages: {
                username: {
                    required: "用户名不能为空."
                },
                password: {
                    required: "密码不能为空."
                }
            },

            invalidHandler: function (event, validator) {  
                $('.alert-error', $('.login-form')).show();
            },

            highlight: function (element) {
                $(element).closest('.control-group').addClass('error');
            },

            success: function (label) {
                label.closest('.control-group').removeClass('error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
            	form.submit();
            }
        });

        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                	form.submit();
                }
                return false;
            }
        });

        $('.forget-form').validate({
            errorElement: 'label', 
            errorClass: 'help-inline', 
            focusInvalid: false, 
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },

            messages: {
                email: {
                    required: "邮箱不能为空."
                }
            },

            invalidHandler: function (event, validator) {  

            },

            highlight: function (element) {
                $(element)
                    .closest('.control-group').addClass('error');
            },

            success: function (label) {
                label.closest('.control-group').removeClass('error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
            	form.submit();
            }
        });

        $('.forget-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                	form.submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function () {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

        $('.register-form').validate({
            errorElement: 'label',
            errorClass: 'help-inline',
            focusInvalid: false,
            ignore: "",
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                rpassword: {
                    equalTo: "#register_password"
                },
                email: {
                    required: true,
                    email: true
                },
                tnc: {
                    required: true
                }
            },

            messages: {
                tnc: {
                    required: "请先接受服务条款."
                }
            },

            invalidHandler: function (event, validator) {   

            },

            highlight: function (element) {
                $(element).closest('.control-group').addClass('error');
            },

            success: function (label) {
                label.closest('.control-group').removeClass('error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                if (element.attr("name") == "tnc") {                  
                    error.addClass('help-small no-left-padding').insertAfter($('#register_tnc_error'));
                } else {
                    error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
                }
            },

            submitHandler: function (form) {
            	form.submit();
            }
        });

        jQuery('#register-btn').click(function () {
            jQuery('.login-form').hide();
            jQuery('.register-form').show();
        });

        jQuery('#register-back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.register-form').hide();
        });
    }
};
}();