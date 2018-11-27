

(function($){

	$(document).ready(function(){

		// ------------------------
		// init
		// ------------------------
		var target = $('.jnilla-gallery.rotator2');
		if(!target.length) return;

		var classLeft     = ["left0 default0","left1 default1","left2 default2","left3 default3","left4 default4","left5 default5"];
		var classRight    = ["right0 default0","right1 default1","right2 default2","right3 default3","right4 default4","right5 default5"];
		var classLR				= classLeft.join(" ") + " " + classRight.join(" ");
		var sliderStyle1 	= target.find('.style1');
		var interval = target.find('.gallery-items').data('interval');

		// ------------------------
		// events
		// ------------------------
		// galleries iteration
		target.each(function() {

			//get some values
			var idgallery = $(this).attr('id');
			var parent = $('#'+idgallery+' .gallery-items');

			// events for setting gallery resize
			// resize style1
			sliderStyle1.on("ajustar", function(){

				$(this).find('.gallery-items').css({
					"height": Math.ceil(sliderStyle1.width() * 18.4 / 100)
				});

				$(this).find('.gallery-item').css({
					"width": Math.ceil(sliderStyle1.width() * 24.4 / 100)
				});

			});
			sliderStyle1.trigger("ajustar");

			// events for window resize
			$(window).on("resize", function(){
				sliderStyle1.trigger("ajustar");
			});


			//events for left and rigth click controls
			$('#'+idgallery+'').on('click', '.controls.right', function(){
				intervalManager(false);
				$(this).hide();
				$('#'+idgallery+' .controls.left').hide();
				setNext();
				setTimeout(function () {
					//init carousel transition
					intervalManager(true, animate, interval);
				}, 1000);
			});

			$('#'+idgallery+'').on('click', '.controls.left', function(){
				intervalManager(false);
				$(this).hide();
				$('#'+idgallery+' .controls.right').hide();
				setPrev();
				setTimeout(function () {
					//init carousel transition
					intervalManager(true, animate, interval);
				}, 1000);
			});

			// ------------------------
			// functions
			// ------------------------
			function setPrev(){
				var count = parent.find(".gallery-item").length;
				var item = parent.find(".gallery-item").eq(count - 1).clone(true);

				parent.prepend(item);
				for(var i = 0; i < count+1; i++){
					parent.find(".gallery-item").eq(i).removeClass(classLR).addClass(classLeft[i]);
				}
				setTimeout(function(){
					parent.find(".gallery-item").eq(count).remove();
				}, 800);
				setTimeout(function () {
					$('#'+idgallery+' .controls').show();
				}, 1000);

			}

			function setNext(){
				var count = parent.find(".gallery-item").length;
				var item = parent.find(".gallery-item").eq(0).clone(true);

				parent.append(item);
				for(var i = 0; i < count+1; i++){
					parent.find(".gallery-item").eq(i).removeClass(classLR).addClass(classRight[i]);
				}
				setTimeout(function(){
					parent.find(".gallery-item").eq(0).remove();
				}, 800);
				setTimeout(function () {
					$('#'+idgallery+' .controls').show();
				}, 1000);
			}

			//transition carousel
			var animate = function () {
				$('#'+idgallery+' .controls.left, #'+idgallery+' .controls.right').hide();
				setNext();
			}
			var timer = null;
			function intervalManager(flag, animate, time) {
				if(flag)
				timer =  setInterval(animate, time);
				else
				clearInterval(timer);
			}
			//init carousel transition
			intervalManager(true, animate, interval);

		}); //end each


	});
})(jQuery);
