//--------------------------------------
// Jnilla Animate v0.0.4
//--------------------------------------
/*
Events:

jn - animation - scroll: Event fired when the middle point of the element is inside the viewport.
jn - animation - hover: Event fired on mouse hover.
Event modifiers
jn - animation - repeat: Enable events to fire more than once.
Animations
jn - animation - fade: Fade animation
jn - animation - zoom: Zoom + fade animation
jn - animation - fly - from - [direciont]: Fly + fade animation.The direction options are: above, below, left, right
Animation modifiers
jn - animation - slow: Modifies animation duration to 1000 ms
jn - animation - fast: Modifies animation duration to 300 ms
*/

(function ($) {
	$(document).ready(function () {

		if (!$('[class*="jn-animation-"]').length) return;

		// -------------------------
		// Init
		// -------------------------
		setTimeout(function () {
			pollScroll();
		}, 500);


		// -------------------------
		// Events
		// -------------------------

		$(window).scroll(function () {
			pollScroll();
		});

		$(window).resize(function () {
			pollScroll();
		});

		$('.jn-animation-hover').mouseenter(function () {
			setStatus($(this), true);
		});

		$('.jn-animation-hover').mouseleave(function () {
			if ($(this).hasClass('jn-animation-repeat')) {
				setStatus($(this), false);
			}
		});


		// -------------------------
		// Functions
		// -------------------------

		// Poll elements to execute scroll meta event
		function pollScroll() {
			$('.jn-animation-scroll').each(function () {
				var el = $(this);
				if (isInRange(el)) {
					setStatus(el, true);
				} else {
					if (el.hasClass('jn-animation-repeat')) {
						setStatus(el, false);
					}
				}
			});
		}

		// Set element status
		function setStatus(el, status) {
			if (status) {
				if (el.hasClass('jn-animation-active')) return;
				el.addClass('jn-animation-active');
			} else {
				if (!el.hasClass('jn-animation-active')) return;
				el.removeClass('jn-animation-active');
			}
		}

		// Caclculates if the element is in visual range
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

	});
})(jQuery);