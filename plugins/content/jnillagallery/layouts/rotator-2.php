<?php
// no direct access
defined ( '_JEXEC' ) or die ();
// $introcount = (count($list));
$uid = "slider".uniqid();

$document = JFactory::getDocument();
$document->addStyleSheet('plugins/content/jnillagallery/media/css/rotator-2.css');
$document->addScript('plugins/content/jnillagallery/media/js/rotator-2.js');


//use modal gallery
if($jnbox == 'true') {
	$document->addStyleSheet('plugins/content/jnillagallery/media/css/jn-slide-gallery.css');
	$document->addScript('plugins/content/jnillagallery/media/js/jn-slide-gallery.js');
}

//interval
$interval = intval($interval);
$interval = $interval*1000;

?>
<!-- LAYOUT ROTATOR 2 -->
<div class="jnilla-gallery rotator2" id="<?php echo $uid; ?>">
	<?php if($jnbox == 'true'): ?>
	<div class="rotator-2 gallery style1">
	<?php else: ?>
	<div class="rotator-2 style1">
	<?php endif; ?>
		<!-- rotator 2 items -->
		<?php if($type == 'images'): ?>
		<!-- layout images -->
		<div class="gallery-items rotator-items" data-interval="<?php echo $interval; ?>">
			<?php $n = -1; ?>
			<?php foreach ($files as $item) : ?>
				<?php $n++;
				//get name from file
				$info = pathinfo($item);
				$file_name =  basename($item,'.'.$info['extension']);
				$file_name = str_replace('-', ' ', $file_name);
				?>
				<div class="img-container gallery-item <?php if($n==0 || $n<=4) echo 'default'.$n; ?>" data-src="<?php echo $galleryPath."/".$item; ?>">
					<img class="jn-gallery-thumb jn-holder" data-ratio="tv" src="<?php echo $galleryPath."/".$item; ?>" data-src="<?php echo $galleryPath."/".$item; ?>">
          <div class="rollover"><span class="icon-zoom-in fa fa-search-plus"></span></div>
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
				<div class="img-container gallery-item <?php if($n==0 || $n<=4) echo 'default'.$n; ?>">
					<img class="jn-gallery-thumb jn-holder vid" data-ratio="tv" src="<?php echo $srcimage; ?>" data-src='<?php echo $video; ?>'>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
		<div class="controls left"><img src="plugins/content/jnillagallery/media/images/arrow-left.png" alt="arrow left"></div>
		<div class="controls right"><img src="plugins/content/jnillagallery/media/images/arrow-right.png" alt="arrow right"></div>
	</div>
</div>
<div class="clearfix"></div>
