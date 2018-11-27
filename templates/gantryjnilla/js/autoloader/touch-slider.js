//--------------------------------------
// touch slider behavior
//--------------------------------------
(function ($) {
	$(document).ready(function () {

		$(".carousel").swipe({

			swipe: function (event, direction, distance, duration, fingerCount, fingerData) {

				if (direction == 'left') $(this).carousel('next');
				if (direction == 'right') $(this).carousel('prev');

			},
			allowPageScroll: "vertical"

		});

		//para controlar el click
		$('.carousel-inner').mousedown(function () {
			$(this).css('cursor', '-webkit-grabbing');
			$(this).css('cursor', '-moz-grabbing');
			$(this).css('cursor', 'grabbing');

		});
		$('.carousel-inner').mouseup(function () {
			$(this).css('cursor', '-webkit-grab');
			$(this).css('cursor', '-moz-grab');
			$(this).css('cursor', 'grab');

		});
	});

})(jQuery);