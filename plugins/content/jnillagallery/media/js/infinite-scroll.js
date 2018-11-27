//---------------------------------------
// infinite scroll
//---------------------------------------
(function($) {
	$(document).ready(function() {
		var els = $('.jnilla-gallery.infinite-scroll');
		if (!els.length) return;


		// declarations
		var offset, y, pagination, next, buffer, items, request;
		var requesting = false;
		var index = 0;
		var url = $('.jnilla-gallery .pagination a[title="Next"]').attr('href');
		var marker = $('<div class="page-autoload-marker"><span class="btn btn-inverse">Loading...</span></div>');

		//get space between images
		var spaced = els.find('.default, .masonry').hasClass('spaced');

		//value the selected grid
		var grid = els.data('grid');
		var newGrid, span;

		if (spaced === true){
			switch (grid) {
				case 2:
				newGrid = $('<div class="items hidden-phone"><div class="row-fluid"><div class="span6"></div><div class="span6"></div></div></div>');
				span = '.span6';
				break;
				case 3:
				newGrid = $('<div class="items hidden-phone"><div class="row-fluid"><div class="span4"></div><div class="span4"></div><div class="span4"></div></div></div>');
				span = '.span4';
				break;
				case 4:
				newGrid = $('<div class="items hidden-phone"><div class="row-fluid"><div class="span3"></div><div class="span3"></div><div class="span3"></div><div class="span3"></div></div></div>');
				span = '.span3';
				break;
				case 5:
				newGrid = $('<div class="items hidden-phone"><div class="row-fluid"><div class="span2"></div><div class="span2"></div><div class="span2"></div><div class="span2"></div><div class="span2"></div></div></div>');
				span = '.span2';
				break;
				case 6:
				newGrid = $('<div class="items hidden-phone"><div class="row-fluid"><div class="span2"></div><div class="span2"></div><div class="span2"></div><div class="span2"></div><div class="span2"></div><div class="span2"></div></div></div>');
				span = '.span2';
				break;
				default:
				newGrid = $('<div class="items hidden-phone"><div class="row-fluid"><div class="span6"></div><div class="span6"></div></div></div>');
				span = '.span6';

			}
		}else {
			switch (grid) {
				case 2:
				newGrid = $('<div class="items hidden-phone"><div class="jn-row-fluid"><div class="jn-span-6"></div><div class="jn-span-6"></div></div></div>');
				span = '.jn-span-6';
				break;
				case 3:
				newGrid = $('<div class="items hidden-phone"><div class="jn-row-fluid"><div class="jn-span-4"></div><div class="jn-span-4"></div><div class="jn-span-4"></div></div></div>');
				span = '.jn-span-4';
				break;
				case 4:
				newGrid = $('<div class="items hidden-phone"><div class="jn-row-fluid"><div class="jn-span-3"></div><div class="jn-span-3"></div><div class="jn-span-3"></div><div class="jn-span-3"></div></div></div>');
				span = '.jn-span-3';
				break;
				case 5:
				newGrid = $('<div class="items hidden-phone"><div class="jn-row-fluid"><div class="jn-span-2"></div><div class="jn-span-2"></div><div class="jn-span-2"></div><div class="jn-span-2"></div><div class="jn-span-2"></div></div></div>');
				span = '.jn-span-2';
				break;
				case 6:
				newGrid = $('<div class="items hidden-phone"><div class="jn-row-fluid"><div class="jn-span-2"></div><div class="jn-span-2"></div><div class="jn-span-2"></div><div class="jn-span-2"></div><div class="jn-span-2"></div><div class="jn-span-2"></div></div></div>');
				span = '.jn-span-2';
				break;
				default:
				newGrid = $('<div class="items hidden-phone"><div class="jn-row-fluid"><div class="jn-span-6"></div><div class="jn-span-6"></div></div></div>');
				span = '.jn-span-6';

			}
		}

		// prepare
		els.append(marker);
		$('.pagination').remove();
		items = $('.jnilla-gallery .default .item, .jnilla-gallery .masonry .item');
		$('.jnilla-gallery .default .row-fluid, .jnilla-gallery .masonry .row-fluid, .jnilla-gallery .default .jn-row-fluid, .jnilla-gallery .masonry .jn-row-fluid').remove();
		$('.jnilla-gallery .default, .jnilla-gallery .masonry').prepend(newGrid.html());
		// $('.jnilla-gallery .default').prepend($('<div class="visible-phone mobile-container"></div>'));
		insertItems();

		// insert marker
		marker.insertAfter(pagination);

		// trigger
		var timer = setInterval(function()
		{
			offset = marker.offset();
			y = offset.top-$(window).scrollTop()-$(window).height();
			if (y < 0) loadNext();
		}, 1000);

		// load next page
		function loadNext()
		{
			if(requesting) return;
			requesting = true;

			// no more pages
			if(!url)
			{
				clearInterval(timer);
				marker.remove();
				return;
			}

			$.get(url)
			.done(function(data)
			{
				buffer = $(data);
				items = buffer.find('.jnilla-gallery .default .item, .jnilla-gallery .masonry .item');
				url = buffer.find('.jnilla-gallery .pagination a[title="Next"]').attr('href');
				insertItems();
				var els = $('.gallery').find('.gallery-item .img, .gallery-item .vid, .rotator .gallery-item, .masonry .gallery-item, .default .gallery-item');
				els.off('click');
				$('.gallery').jn_gallery();

			})
			.always(function()
			{
				requesting = false;
			});
		}

		// insert the items
		function insertItems() {
			$(items).each(function() {
				if(index > grid-1) index = 0;
				$(this).addClass('new');
				$('.jnilla-gallery .default .row-fluid '+span).eq(index).append($(this));
				$('.jnilla-gallery .masonry .row-fluid '+span).eq(index).append($(this));
				if (spaced === false){
					$('.jnilla-gallery .default .jn-row-fluid '+span).eq(index).append($(this));
					$('.jnilla-gallery .masonry .jn-row-fluid '+span).eq(index).append($(this));
				}
				// $('.jnilla-gallery .default .mobile-container').append($(this).clone());
				$(this).find('img').each(function() {
					$(this).jn_holder();
				});
				index++;
				setTimeout(function() {
					$('.jnilla-gallery .default .item.new, .jnilla-gallery .masonry .item.new').removeClass('new');
				}, 1000);
			});
		}

		setInterval(function(){
			var btnInv = $('.jnilla-gallery .btn-inverse');
			btnInv.toggleClass('blink');
		},500);

	});
})(jQuery);
