///////////////////////////////////
// Drawer behavior
//////////////////////////////////

(function ($) {

	$(document).ready(function () {
		var modMobile = $('.mod-menu-mobile');
		modMobile.append('<i class="fa fa-remove iconClose2 jn-drawer-close"> </i>');

		//menu drawer
		if (!modMobile.length) {
			return;
		} else {
			detectedDrawer();
			$('body').on('click', '.jn-drawer-toggle, .jn-drawer-body, .iconClose2', function () {
				detectedDrawer();
			});

			// close button
			$('body').on('click', '.jn-drawer-close', function (event) {
				reset();
			});
		}
		///////////////////////////////

	});

	//detect drawer function
	function detectedDrawer() {
		var iconRemove = $('.fa-remove');
		var iconReorder = $('.fa-reorder');
		if ($('.jn-drawer-open').length) {
			iconRemove.fadeIn();
			iconReorder.fadeOut(200);
		} else {
			iconRemove.fadeOut(200);
			iconReorder.fadeIn();
		}
	}

	function reset() {
		$('html, body, .jn-drawer-open').removeClass('jn-drawer-open');
		$('.jn-drawer-body').removeClass('jn-drawer-body-left jn-drawer-body-right');
	}

})(jQuery);