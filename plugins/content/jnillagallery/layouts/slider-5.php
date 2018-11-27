<?php
// no direct access
defined ( '_JEXEC' ) or die ();
// $introcount = (count($list));
$uid = "slider".uniqid();

$document = JFactory::getDocument();
$document->addStyleSheet('plugins/content/jnillagallery/media/css/slider5.css');
$document->addScript('plugins/content/jnillagallery/media/js/slider.js');

//use modal gallery
if($jnbox == 'true') {
	$document->addStyleSheet('plugins/content/jnillagallery/media/css/jn-slide-gallery.css');
	$document->addScript('plugins/content/jnillagallery/media/js/jn-slide-gallery.js');
}


?>

<!-- LAYOUT SLIDER 5 -->
<div class="jnilla-gallery slider" id="<?php echo $uid; ?>">
	<?php if($jnbox == true): ?>
	<div class="slider-5 style2 gallery">
	<?php else: ?>
	<div class="slider-5 style2">
	<?php endif; ?>
		<!-- Slider items -->
		<?php if($type == 'images'): ?>
		<div class="gallery-items">
			<?php $n = -1; ?>
			<?php foreach ($files as $item) : ?>
				<?php $n++;
				//get name from file
				$info = pathinfo($item);
				$file_name =  basename($item,'.'.$info['extension']);
				$file_name = str_replace('-', ' ', $file_name);
				?>
				<div class="gallery-item <?php if($n==0 || $n<=4) echo 'default'.$n; ?>">
					<img class="jn-gallery-thumb jn-holder img" data-ratio="wide" src="<?php echo $galleryPath."/".$item; ?>" data-src="<?php echo $galleryPath."/".$item; ?>">
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
	<?php endif; ?>

	<?php if($type == 'videos'): ?>
	<!-- layout videos -->
		<div class="gallery-items">
			<?php $n = -1; ?>
			<?php $videos = json_decode($videos,true); ?>
			<?php foreach ($videos as $item) : ?>
				<?php $n++;

				//get items videos and get intro image from video
				$urlvideo = $item["url_video"];
				$re = '/v=.+/u';
				preg_match($re, $urlvideo, $matches);
				$idvideo = $matches[0];
				$idvideo = str_replace('v=','', $idvideo);

				$srcimage = "https://img.youtube.com/vi/$idvideo/hqdefault.jpg";
				$video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$idvideo.'?rel=0" frameborder="0" allowfullscreen></iframe>';
				//get video title
				$vtitle = $item["title"];
				$vtitle = explode('-', $vtitle);
				$vtitle = implode(' ', $vtitle);

				?>
				<div class="gallery-item videos <?php if($n==0 || $n<=4) echo 'default'.$n; ?>">
					<img class="jn-gallery-thumb jn-holder" data-ratio="wide" src="<?php echo $srcimage; ?>">
					<div class="rollover vid" data-src='<?php echo $video; ?>'><img src="plugins/content/jnillagallery/media/images/play.png" alt="PLAY"></div>
					<?php if($caption == 'true') : ?>
						<?php if($stylecaption == 'inside'): ?>
							<div class="carousel-caption">
								<h4><?php echo $vtitle; ?></h4>
							</div>
						<?php else: ?>
							<div class="outside-caption">
								<h4><?php echo $vtitle; ?></h4>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
		<div class="controls left"><i class="icon-angle-left fa fa-angle-left"></i></div>
		<div class="controls right"><i class="icon-angle-right fa fa-angle-right"></i></div>
	</div>
</div>
<div class="clearfix"></div>
