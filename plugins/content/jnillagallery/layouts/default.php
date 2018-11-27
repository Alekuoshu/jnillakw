<?php
// no direct access
defined ( '_JEXEC' ) or die ();
$buffer = array();
$uid = "jngallery-".uniqid();

$document = JFactory::getDocument();
$document->addStyleSheet('plugins/content/jnillagallery/media/css/default.css');
$document->addStyleSheet('plugins/content/jnillagallery/media/css/page-autoload-marker.css');
$document->addStyleSheet('plugins/content/jnillagallery/media/css/jn-slide-gallery.css');
$document->addScript('plugins/content/jnillagallery/media/js/infinite-scroll.js');
// $document->addScript('plugins/content/jnillagallery/media/js/show-more.js');
$document->addScript('plugins/content/jnillagallery/media/js/jn-slide-gallery.js');

$grid = intval($colsNum);
if ($spaceBetween == 'true') {
	$spaced = true;
}else {
	$spaced = false;
}

if($grid == 5) {
	$layoutEven = 'layoutEven';
}
?>

<?php if ($infiniteScroll == "true"): ?>
	<div id="<?php echo $uid; ?>" class="jnilla-gallery infinite-scroll gallery" data-grid="<?php echo $grid; ?>">
	<?php else: ?>
		<div id="<?php echo $uid; ?>" class="jnilla-gallery gallery" data-grid="<?php echo $grid; ?>">
		<?php endif; ?>
		<?php if($type == 'images'): ?>
		<div class="default <?php echo $layoutEven; ?> <?php if ($spaceBetween == 'true') echo 'spaced'; ?>">
			<?php foreach ($files as $item) : ?>
				<?php ob_start(); ?>
				<div class="item img-container gallery-item img" data-src="<?php echo $galleryPath."/".$item; ?>">
					<img class="jn-gallery-thumb jn-holder" data-ratio="box" src="<?php echo $galleryPath."/".$item; ?>">
					<div class="rollover"><span class="icon-zoom-in fa fa-search-plus"></span></div>
				</div>
				<?php $buffer[] = ob_get_clean(); ?>
			<?php endforeach; ?>
			<?php
			include_once JPATH_PLUGINS."/content/jnillagallery/assets/paginator.php";
			if (isset($_GET[p]))
			$p = $_GET[p];
			else
			$p=1;
			//init paginator
			paginator($buffer, $numPages, $p, $grid, $spaced);
			?>
		</div>
		<?php endif; ?>

		<?php if($type == 'videos'): ?>
			<!-- layout videos -->
			<div class="default videos <?php echo $layoutEven; ?> <?php if ($spaceBetween == 'true') echo 'spaced'; ?>">
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

					<?php ob_start(); ?>
					<div class="gallery-item item img-container">
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
					<?php $buffer[] = ob_get_clean(); ?>
				<?php endforeach; ?>
				<?php
				include_once JPATH_PLUGINS."/content/jnillagallery/assets/paginator.php";
				if (isset($_GET[p]))
				$p = $_GET[p];
				else
				$p=1;
				//init paginator
				paginator($buffer, $numPages, $p, $grid, $spaced);
				?>
			</div>
		<?php endif; ?>
	</div>
	<div class="clearfix"></div>
