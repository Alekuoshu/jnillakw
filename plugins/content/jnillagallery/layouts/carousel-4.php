<?php
// no direct access
defined ( '_JEXEC' ) or die ();
$uid = "slider-".uniqid();
$introcount = (count($list));

$document = JFactory::getDocument();
$document->addStyleSheet('plugins/content/jnillagallery/media/css/carousel-4.css');
$document->addScript('plugins/content/jnillagallery/media/js/carousel-4.js');

if($interval){
	$interval = intval($interval);
	$interval = $interval*1000;
}else {
	$interval = 0;
}

?>
<div class="jnilla-gallery">
	<div class="carousel-4">
		<a class="left carousel-control icon-angle-left fa fa-angle-left" href="<?php echo "#$uid"; ?>" data-slide="prev"></a>
		<div class="row-fluid">
			<div class="span5">
				<div class="img-container"></div>
			</div>
			<div class="span7">
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
								<div class="item <?php if($n2 == 0) echo "active"; ?>">
									<div class="main-content">
									<?php endif; ?>
									<div class="content-item item-<?php echo $n; ?>" style="cursor:pointer">
										<div class="content-img">
											<img class="jn-gallery-thumb jn-holder" data-ratio="box" src="<?php echo $galleryPath."/".$item; ?>">
											<div class="rollover"><span class="icon-eye-open"></span></div>
										</div>
									</div>
									<?php if($n == 4 || $n2 == $total) : ?>
										<?php $n = -1;?>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<ol class="carousel-indicators">
						<?php
						$n = -1;
						$n2 = -1;
						$total = count($files)-1;
						?>
						<?php foreach ($files as $item) : ?>
							<?php $n++; $n2++; ?>
							<?php if($n == 0) :?>
								<li data-target="<?php echo "#$uid"; ?>" data-slide-to="<?php echo $n2/5; ?>" <?php if($n2/5==0) echo "class=\"active\""?>>
								<?php endif; ?>
								<?php if($n == 4 || $n2 == $total) : ?>
									<?php $n = -1;?>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ol>
				</div>
			</div>
		</div>
		<a class="right carousel-control icon-angle-right fa fa-angle-right" href="<?php echo "#$uid"; ?>" data-slide="next"></a>
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
