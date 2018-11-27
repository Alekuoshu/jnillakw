//--------------------------------------
// Contact form behavior
//--------------------------------------
(function ($) {
    $(document).ready(function () {

        var target = $('.jnilla-contact-form');
        if (!target.length) return;

        target.find('.control-group input, .control-group textarea').on('focus', function () {
            $(this).parent().addClass('focus');
        });

        target.find('.control-group input, .control-group textarea').on('blur', function () {
            if ($(this).val() === "") {
                $(this).parent().removeClass('focus');
            }
        });

    });
})(jQuery);