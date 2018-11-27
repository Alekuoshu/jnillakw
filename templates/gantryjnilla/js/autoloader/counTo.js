//--------------------------------------
// Count To behavior
//--------------------------------------
(function ($) {
    $(document).ready(function () {

        /*-----------------------------------------------------------------
        	Caclculates if the element is in visual range
        	-------------------------------------------------------------------*/
        function isInRange(el) {
            var winH = $(window).height();
            var winScrollTop = $(window).scrollTop();
            var elH = el.outerHeight();
            var elTop = el.offset().top;
            var elScrollTop = elTop - winScrollTop;
            var elScrollBottom = elScrollTop + elH;
            var rangeTop = 0;
            var rangeBottom = parseInt(winH * 0.75);

            if ((elScrollTop < rangeBottom) &&
                (elScrollBottom > rangeTop)) {
                return true;
            } else {
                return false;
            }
        }

        /*-----------------------------------------------------------------
        Init statistics
        -------------------------------------------------------------------*/
        var statistics = $('#section-statistics');
        if (statistics.length) {
            var flag = false;
            $(window).scroll(function () {
                if (isInRange(statistics) && flag == false) {
                    $('.amount').countTo({
                        onUpdate: function (value) {
                            flag = true;
                        },
                        onComplete: function (value) {
                            flag = true;
                            console.log('statistics is done!');
                        }
                    });
                }

            });
        }
    });
})(jQuery);