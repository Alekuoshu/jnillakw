<?php
// no direct access
defined ( '_JEXEC' ) or die ();
$buffer = array();
$uid = "jngallery-".uniqid();

$document = JFactory::getDocument();
$document->addStyleSheet('plugins/content/jnillagallery/media/css/masonry.css');
$document->addStyleSheet('plugins/content/jnillagallery/media/css/page-autoload-marker.css');
$document->addScript('plugins/content/jnillagallery/media/js/infinite-scroll.js');
$document->addStyleSheet('plugins/content/jnillagallery/media/css/jn-slide-gallery.css');
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


	<div id="<?php echo $uid; ?>" class="jnilla-gallery infinite-scroll gallery" data-grid="<?php echo $grid; ?>">
		<div class="masonry <?php echo $layoutEven; ?> <?php if ($spaceBetween == 'true') echo 'spaced'; ?>">
			<?php foreach ($files as $item) : ?>
				<?php ob_start(); ?>
					<div class="item img-container gallery-item" data-src="<?php echo $galleryPath."/".$item; ?>">
						<img class="jn-gallery-thumb" src="<?php echo $galleryPath."/".$item; ?>">
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
	</div>
	<div class="clearfix"></div>
