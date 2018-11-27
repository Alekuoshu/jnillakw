// //--------------------------------------
// // mod-search
// //--------------------------------------
// (function($)
// {
// 	$(document).ready(function()
// 	{
// 		var target = $('.mod-search');
// 		if (!target.length) return;
// 		var itemsearch = $('.icon-search');
//
// 		$('html').click(function(e) {
// 			target.removeClass('Active');
// 		});
// 		itemsearch.click(function(e){
// 			e.preventDefault();
// 			e.stopPropagation();
// 			target.toggleClass('Active');
// 			$('#mod-search-searchword').focus();
// 		});
//
// 		target.click(function(e){
// 			$(this).addClass('Active');
// 			e.stopPropagation();
// 		});
//
// 	});
//
//
// })(jQuery);
