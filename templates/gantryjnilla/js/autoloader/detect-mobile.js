/*-----------------------------------------------------------------
	Detect device mobile
	-------------------------------------------------------------------*/
(function ($) {
    $(document).ready(function () {

        var isMobile = false;

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            $('html').addClass('touch');
            isMobile = true;
        } else {
            $('html').addClass('no-touch');
            isMobile = false;
        }

    });
})(jQuery);