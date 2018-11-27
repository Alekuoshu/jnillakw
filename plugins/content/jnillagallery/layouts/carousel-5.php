<?php
// no direct access
defined ( '_JEXEC' ) or die ();
$uid = "slider-".uniqid();
$introcount = (count($list));

$document = JFactory::getDocument();
$document->addStyleSheet('plugins/content/jnillagallery/media/css/carousel-5.css');
$document->addScript('plugins/content/jnillagallery/media/js/carousel-5.js');


//use modal gallery
if($jnbox == 'true') {
	$document->addStyleSheet('plugins/content/jnillagallery/media/css/jn-slide-gallery.css');
	$document->addScript('plugins/content/jnillagallery/media/js/jn-slide-gallery.js');
}

if($interval){
	$interval = intval($interval);
	$interval = $interval*1000;
}else {
	$interval = 0;
}
?>

<div class="jnilla-gallery">
	<?php if($jnbox == 'true'): ?>
	<div class="carousel-5 gallery">
	<?php else: ?>
	<div class="carousel-5">
	<?php endif; ?>
		<div id="<?php echo $uid; ?>" class="carousel slide">
			<!-- Carousel items -->
			<div class="carousel-inner">
				<?php
				$n = -1;
				$n2 = -1;
				$total = count($files)-1;
				?>
				<?php foreach ($files as $item) : ?>
					<?php $n++; $n2++; ?>
					<?php if($n == 0) :?>
						<?php
						?>
						<div class="item gallery-item <?php if($n2 == 0) echo "active"; ?>">
							<div class="main-content">
							<?php endif; ?>
							<div class="content-item item-<?php echo $n; ?>" style="cursor:pointer">
								<div class="content-img">
									<img class="jn-gallery-thumb jn-holder" data-ratio="box" src="<?php echo $galleryPath."/".$item; ?>">
									<div class="rollover img" data-src="<?php echo $galleryPath."/".$item; ?>"><span class="plus">+</span></div>
								</div>
							</div>
							<?php if($n == 3 || $n2 == $total) : ?>
								<?php $n = -1;?>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<!-- <ol class="carousel-indicators">
				<?php
				// $n = -1;
				// $n2 = -1;
				// $total = count($files)-1;
				?>
				<?php //foreach ($files as $item) : ?>
					<?php //$n++; $n2++; ?>
					<?php //if($n == 0) :?>
						<li data-target="<?php //echo "#$uid"; ?>" data-slide-to="<?php //echo $n2/5; ?>" <?php //if($n2/5==0) echo "class=\"active\""?>>
						<?php //endif; ?>
						<?php //if($n == 3 || $n2 == $total) : ?>
							<?php //$n = -1;?>
						</li>
					<?php //endif; ?>
				<?php //endforeach; ?>
			</ol> -->
		</div>
		<a class="left carousel-control icon-long-arrow-left fa fa-long-arrow-left" href="<?php echo "#$uid"; ?>" data-slide="prev"></a>
		<a class="right carousel-control icon-long-arrow-right fa fa-long-arrow-right" href="<?php echo "#$uid"; ?>" data-slide="next"></a>
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
