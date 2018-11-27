

(function($){

	$(document).ready(function(){

		// ------------------------
		// init
		// ------------------------
		var target = $('.jnilla-gallery.slider');
		if(!target.length) return;

		var classLeft     = ["left0 default0","left1 default1","left2 default2","left3 default3","left4 default4","left5 default5"];
		var classRight    = ["right0 default0","right1 default1","right2 default2","right3 default3","right4 default4","right5 default5"];
		var classLR				= classLeft.join(" ") + " " + classRight.join(" ");
		var sliderStyle1 	= target.find('.style1');
		var sliderStyle2 	= target.find('.style2');

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
					"height": Math.ceil(sliderStyle1.width() * 33 / 100)
				});

				$(this).find('.gallery-item').css({
					"width": Math.ceil(sliderStyle1.width() * 58.66 / 100)
				});

			});
			sliderStyle1.trigger("ajustar");

			// resize style2
			sliderStyle2.on("ajustar", function(){

				$(this).find('.gallery-items').css({
					"height": Math.ceil(sliderStyle2.width() * 27 / 100)
				});

				$(this).find('.gallery-item').css({
					"width": Math.ceil(sliderStyle2.width() * 45 / 100)
				});

			});
			sliderStyle2.trigger("ajustar");

			// events for window resize
			$(window).on("resize", function(){
				sliderStyle1.trigger("ajustar");
				sliderStyle2.trigger("ajustar");
			});

			//events for left and rigth click controls
			$('#'+idgallery+'').on('click', '.controls.right', function(){
				$(this).hide();
				$('#'+idgallery+' .controls.left').hide();
				setNext();
			});

			$('#'+idgallery+'').on('click', '.controls.left', function(){
				$(this).hide();
				$('#'+idgallery+' .controls.right').hide();
				setPrev();
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

		}); //end each


	});
})(jQuery);
