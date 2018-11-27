//--------------------------------------
// to top button behavior
//--------------------------------------
(function ($) {
	$(document).ready(function () {
		var toTop = $('<div title="Go to Top" class="to-top btn btn-inverse"><span class="fa fa-chevron-up"></span> </div>').prependTo('body');
		toTop.click(function () {
			$('html, body').animate({
				scrollTop: $("body").offset().top
			}, 500);
		});

		//efecto blur
		$(document).scroll(function () {
			var scroll = $(window).scrollTop().valueOf();
			if (scroll > 400) {
				$('.to-top').addClass('Active');
			}
			if (scroll < 400) {
				$('.to-top').removeClass('Active');
			}
		});

	});

})(jQuery);