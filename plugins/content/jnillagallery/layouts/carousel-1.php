<?php
// no direct access
defined ( '_JEXEC' ) or die ();
// $introcount = (count($list));
$uid = "slider-".uniqid();

$document = JFactory::getDocument();
$document->addStyleSheet('plugins/content/jnillagallery/media/css/carousel-1.css');
$document->addScript('plugins/content/jnillagallery/media/js/carousel-1.js');


//use modal gallery
if($jnbox == 'true') {
	$document->addStyleSheet('plugins/content/jnillagallery/media/css/jn-slide-gallery.css');
	$document->addScript('plugins/content/jnillagallery/media/js/jn-slide-gallery.js');
}
//get interval
$interval = intval($interval)*1000;


?>
<!-- LAYOUT CAROUSEL 1 -->
<div class="jnilla-gallery">
	<?php if($jnbox == 'true'): ?>
	<div class="carousel-1 gallery">
	<?php else: ?>
	<div class="carousel-1">
	<?php endif; ?>
		<div id="<?php echo $uid; ?>" class="carousel slide">
			<div class="carousel-indicators">
				<?php $n = -1; ?>
				<?php foreach ($files as $item) : ?>
					<?php $n++; ?>
					<div class="thumb <?php if($n == 0) echo "active"; ?>">
						<div data-target="<?php echo "#$uid"; ?>" data-slide-to="<?php echo $n; ?>" <?php if($n==0) echo "class=\"active\""?> style="cursor:pointer;">
							<img class="jn-gallery-thumb jn-holder" data-ratio="box" src="<?php echo $galleryPath."/".$item; ?>">
						</div>
						<div class="rollover"></div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Carousel items -->
			<div class="carousel-inner img-container">
				<?php $n = -1; ?>
				<?php foreach ($files as $item) : ?>
					<?php $n++;
					//get image size for value
					$size = getimagesize($galleryPath."/".$item);
					//get name from file
					$info = pathinfo($item);
					$file_name =  basename($item,'.'.$info['extension']);
					$file_name = str_replace('-', ' ', $file_name);
					?>
					<div class="item gallery-item <?php if($n==0) echo "active"; ?>">
						<?php if ($size[0] > 700 && $size[1] < 650) : ?>
							<img class="jn-gallery-thumb jn-holder img" data-ratio="wide" src="<?php echo $galleryPath."/".$item; ?>" data-src="<?php echo $galleryPath."/".$item; ?>">
						<?php else: ?>
							<img class="jn-gallery-thumb no-block jn-holder img" data-ratio="wide" src="<?php echo $galleryPath."/".$item; ?>" data-src="<?php echo $galleryPath."/".$item; ?>">
						<?php endif; ?>
						<?php if($caption == 'true') : ?>
							<?php if($stylecaption == 'inside'): ?>
								<div class="carousel-caption">
									<h4><?php echo $file_name; ?></h4>
								</div>
							<?php else: ?>
								<div class="outside-caption">
									<h4><?php echo $file_name; ?></h4>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

				<?php endforeach; ?>
			</div>

			<a class="left carousel-control" href="<?php echo "#$uid"; ?>" data-slide="prev"><i class="icon-angle-left fa fa-angle-left"></i></a>
					<a class="right carousel-control" href="<?php echo "#$uid"; ?>" data-slide="next"><i class="icon-angle-right fa fa-angle-right"></i></a>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<script type="text/javascript">
(function($)
{
	$(document).ready(function()
	{
		$('<?php echo "#$uid"; ?>').carousel({
			interval: <?php echo $interval; ?>
		});
		$('.carousel').each(function(index, element) {
			$(this)[index].slide = null;
		});
	});
})(jQuery);
</script>
