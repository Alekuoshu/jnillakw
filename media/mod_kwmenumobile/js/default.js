///////////////////////////////////
// Default behavior
//////////////////////////////////

(function ($) {

    $(document).ready(function () {
        var modMobile = $('.mod-menu-mobile');

        //menu top
        modMobile.find('.panel-toggle').click(function () {
            var bodyMenu = $('.body-menu');
            bodyMenu.slideFadeToggle();
            modMobile.toggleClass('Active');
        });

        //fix bug menu mobile
        var item = $('.mod-menu-mobile-top .item');
        item.click(function () {
            var bodyMenu = $('.body-menu');
            bodyMenu.slideUp();
            modMobile.removeClass('Active');
        });
        //////////////////////////////////////

        $(window).resize(function () {
            //resize slider
            var menuMobile = $('.mod-menu-mobile-top');
            if (!menuMobile.length) {
                return;
            } else {
                var menuContainer = $('.body-menu');
                var modMenuMain = $('.mod-menu-main-mobile');
                if (!menuContainer.length) return;
                var hvp = $(window).outerHeight(true);
                var hcontentModule = hvp;
                menuContainer.animate({
                    height: hcontentModule
                }, 1);
                // value some requests
                if (hcontentModule <= 500) {
                    modMenuMain.css('height', 320);
                } else {
                    modMenuMain.css('height', 400);
                }
            }

        }).resize();

        $.fn.slideFadeToggle = function (fast) {
            return this.animate({
                opacity: 'toggle',
                height: 'toggle'
            }, 500);
        };
    });

})(jQuery);