$(function() {
    // validation (parsley)
    altair_form_validation.init();
});

// validation (parsley)
altair_form_validation = {
    init: function() {
        var $FormValidate = $('#user_profile');

        $FormValidate
            .parsley()
            .on('form:validated',function() {
                altair_md.update_input($addFormValidate.find('.md-input-danger'));
            })
            .on('field:validated',function(parsleyField) {
                if($(parsleyField.$element).hasClass('md-input')) {
                    altair_md.update_input( $(parsleyField.$element) );
                }
            })
            .on('form:submit', function() {
                return false;
            });

        window.Parsley.on('field:validate', function() {
            var $server_side_error = $(this.$element).closest('.md-input-wrapper').siblings('.error_server_side');
            if($server_side_error) {
                $server_side_error.hide();
            }
        });

    }
};
