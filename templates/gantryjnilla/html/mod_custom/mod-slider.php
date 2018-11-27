<?php
/**
* @package     Joomla.Site
* @subpackage  mod_custom
*
* @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

//get list_items params
$list_items = $params->get('list_items');
$jnholder = $params->get('jnholder');
$effect = $params->get('effect');
if($jnholder == 1){$jn_holder = 'jn-holder jn-holder-block';}else{$jn_holder = '';}
$ratio = $params->get('ratio');
$interval = $params->get('interval');
$interval = $interval*1000;
$uid = "slider-".uniqid();
$n = -1;


?>

<div class="custom <?php echo $effect; ?>" <?php if ($params->get('backgroundimage')) : ?>
	style="background-image:url(
	<?php echo $params->get('backgroundimage'); ?>)"
	<?php endif; ?> >
	<div id="<?php echo $uid; ?>" class="carousel slide">

		<div class="carousel-inner">
			<?php foreach ($list_items as $item) : ?>
			<?php $n++; ?>
			<div class="item <?php if($n==0) echo " active"; ?>">
				<img class="<?php echo $jn_holder; ?>" data-ratio="<?php echo $ratio; ?>" src="<?php echo $item->image; ?>" alt="slider-<?php echo $n; ?>">
				<div class="caption item-<?php echo $n; ?>">
					<?php if($item->text1): ?>
					<div class="text1">
						<?php echo $item->text1; ?>
					</div>
					<?php endif; ?>
					<?php if($item->text2): ?>
					<div class="text2">
						<?php echo $item->text2; ?>
					</div>
					<?php endif; ?>
					<?php if($item->btntext): ?>
					<a class="btn-style-1" href="<?php echo JRoute::_(" index.php?Itemid={$item->btnurl}");
						?>" rel="alternate">
						<?php echo $item->btntext; ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<a class="left carousel-control" href="<?php echo " #$uid"; ?>" data-slide="prev"><i class="fa fa-angle-left"></i></a>
		<a class="right carousel-control" href="<?php echo " #$uid"; ?>" data-slide="next"><i class="fa fa-angle-right"></i></a>
	</div>

	<script type="text/javascript">
		(function ($) {
			$(document).ready(function () {
				$('<?php echo "#$uid"; ?>').carousel({
					interval: <?php echo $interval; ?>,
					pause: false
				});
			});
		})(jQuery);
	</script>
</div>