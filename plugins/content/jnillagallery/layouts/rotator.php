<?php
// no direct access
defined ( '_JEXEC' ) or die ();
$uid = "jngallery-".uniqid();

$document = JFactory::getDocument();
$document->addStyleSheet('plugins/content/jnillagallery/media/css/rotator.css');
$document->addScript('plugins/content/jnillagallery/media/js/jn-gallery-rotator.js');

//use modal gallery
if($jnbox == 'true') {
	$document->addStyleSheet('plugins/content/jnillagallery/media/css/jn-slide-gallery.css');
	$document->addScript('plugins/content/jnillagallery/media/js/jn-slide-gallery.js');
}

$interval = intval($interval);

?>

<?php if($jnbox == 'true'): ?>
<div id="<?php echo $uid; ?>" class="jnilla-gallery gallery">
<?php else: ?>
<div id="<?php echo $uid; ?>" class="jnilla-gallery">
<?php endif; ?>
	<div class="rotator jn-gallery-rotator gallery-items <?php if ($spaceBetween == 'true')echo 'spaced'; ?>" data-interval="<?php echo $interval; ?>">
		<?php foreach ($files as $item) : ?>
			<div class="img-container jn-gallery-rotator-item gallery-item" data-src="<?php echo $galleryPath."/".$item; ?>">
					<img class="jn-gallery-thumb jn-holder" data-ratio="box" src="<?php echo $galleryPath."/".$item; ?>">
					<div class="rollover"><span class="icon-zoom-in fa fa-search-plus"></span></div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<div class="clearfix"></div>
