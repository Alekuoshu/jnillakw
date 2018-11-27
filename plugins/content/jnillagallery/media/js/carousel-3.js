(function($) {

	$(document).ready(function() {
		var gallery = $('.jnilla-gallery .carousel-3');
		if (!gallery.length) return;

		// init
		var thumbnails = gallery.find('.carousel-thumbnails');
		var flag = false;
		var x = 0;
		var y = 0;
		var left = 0 ;
		var w = 0;
		var offset = 0;
		var indicators = thumbnails.find('.carousel-indicators');
		var step = 0;

		// // set carousel height on resize
		// var carousel = gallery.find('.carousel').eq(0);
		// $(window).resize(function() {
		// 	var h = carousel.find('.carousel-inner').eq(0).height();
		// 	carousel.height(h);
		// }).resize();
		// $(window).trigger('resize');

		// thumbnails scroll behavior
		thumbnails.parent().mousemove(function(event) {
			x = event.pageX - $(this).offset().left;
		});


		thumbnails.mouseenter(function(event) {
			flag = true;
			// console.log(flag);
		});
		thumbnails.mouseleave(function(event) {
			flag = false;
			// console.log(flag);
		});

		var animate = function() {
			if(flag === false) return;
			w = thumbnails.width();
			pw = thumbnails.parent().width();
			offset = pw - w;
			left = parseInt(thumbnails.css('left'));
			step = indicators.width();
			// define step direction
			if(x < (pw*15/100)){
				left += step;
			}else if(x > (pw*85/100)){
				left -= step;
			}
			if(flag === false){
				left = 0;
			}
			// limit movement
			if(left > 0){
				left = 0;
			}else if(left < offset){
				left = offset;
			}
			if(w <= pw){
				left = 0;
			}

			thumbnails.css('left', left+"px");

		};


		var timer = setInterval(function() {
			animate();
		}, 500);

	});


})(jQuery);
