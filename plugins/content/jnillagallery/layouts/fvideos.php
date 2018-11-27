<?php
// no direct access
defined ( '_JEXEC' ) or die ();
$buffer = array();
$uid = "jngallery-".uniqid();

$document = JFactory::getDocument();
$document->addStyleSheet('plugins/content/jnillagallery/media/css/fvideos.css');
$document->addStyleSheet('plugins/content/jnillagallery/media/css/jn-slide-gallery.css');
$document->addScript('plugins/content/jnillagallery/media/js/jn-slide-gallery.js');
$n = 0;
?>

<div id="<?php echo $uid; ?>" class="jnilla-gallery gallery">
	<!-- layout fvideos -->
	<div class="fvideos videos">
		<?php $fvideos = json_decode($fvideos,true); ?>

		<?php foreach ($fvideos as $item) : ?>
			<?php $n++;

			//get items videos and get intro image from video
			$urlvideo = $item["url_video"];
			$re = '/v=.+/u';
			preg_match($re, $urlvideo, $matches);
			$idvideo = $matches[0];
			$idvideo = str_replace('v=','', $idvideo);

			$intro_img = $item["intro_img"];
			if($intro_img) {
				$srcimage = $intro_img;
			}else {
				$srcimage = "https://img.youtube.com/vi/$idvideo/hqdefault.jpg";
			}
			$video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$idvideo.'?rel=0" frameborder="0" allowfullscreen></iframe>';
				//get video title
				$vtitle = $item["title"];
				$vtitle = explode('-', $vtitle);
				$vtitle = implode(' ', $vtitle);
				?>

				<?php ob_start(); ?>
				<div class="gallery-item item img-container" id="<?php echo 'gallery-item-'.$n; ?>">
					<img class="jn-gallery-thumb jn-holder jn-holder-block" data-ratio="wide" src="<?php echo $srcimage; ?>">
					<div class="rollover vid" data-src='<?php echo $video; ?>'><span class="icon-play"></span></div>
					<div class="caption">
						<h4><?php echo $vtitle; ?></h4>
					</div>
				</div>
				<?php $buffer[] = ob_get_clean(); ?>
			<?php endforeach; ?>

				<div class="row-fluid">
					<div class="row-fluid">
						<div class="span8">
							<?php echo $buffer[0]; ?>
						</div>
					<div class="span4">
						<?php echo $buffer[1]; ?>
						<?php echo $buffer[2]; ?>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<?php echo $buffer[3]; ?>
				</div>
				<div class="span4">
					<?php echo $buffer[4]; ?>
				</div>
				<div class="span4">
					<?php echo $buffer[5]; ?>
				</div>
			</div>

		</div>
	</div>
	<div class="clearfix"></div>
