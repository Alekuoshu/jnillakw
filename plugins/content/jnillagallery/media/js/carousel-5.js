


(function($){
	$(document).ready(function()	{
		var jnillaGallery = $('.jnilla-gallery .carousel-5');
		if (!jnillaGallery.length) return;

		// resize
		$(window).resize(function() {
			$('.main-content').css('height', 'unset');
			setTimeout(function () {
				var HmainCont = $('.main-content').height();
				$('.main-content').css('height', HmainCont);
				console.log(HmainCont);
			}, 1500);
		}).resize();
		$(window).trigger('resize');

	});

})(jQuery);
