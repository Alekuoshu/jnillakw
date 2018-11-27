


(function($){
	$(document).ready(function()	{
		var jnillaGallery = $('.jnilla-gallery .carousel-2');
		if (!jnillaGallery.length) return;

		jnillaGallery.find('.content-item').click(function() {
			var backgroundImage = $(this).find('.content-img .jn-gallery-thumb').css('background-image');
			var imgContainer = $(this).closest('.jnilla-gallery').find('.img-container');
			// console.log(backgroundImage);//debug

			//extract to src for value image width
			var str1 = backgroundImage.split('url("');
			var str2 = str1[1].split('")');
			var imgwh = $("<img>") // Create a new <img>
			.attr("src", str2[0]) // Copy the src attr from the target <img>
			.load(function() {
				// Print to console for debug
				// console.log("Width:  " + this.width);
				// console.log("Height:  " + this.height);
				if (this.width < 700 || this.height > 650){
					imgContainer.addClass('no-block');
				}else {
					imgContainer.removeClass('no-block');
				}
			});

			imgContainer.attr('style', "background-image:"+backgroundImage);
		});
		$('.jnilla-gallery .carousel-2').each(function() {
			$(this).find('.content-item').eq(0).trigger('click');
		});
	});
})(jQuery);
