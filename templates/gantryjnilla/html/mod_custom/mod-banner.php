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
$jnholder = $params->get('jnholder');
if($jnholder == 1){$jn_holder = 'jn-holder jn-holder-block';}else{$jn_holder = '';}
$ratio = $params->get('ratio');
$image = $params->get('image');
$text1 = $params->get('text1');
$text2 = $params->get('text2');
$btntext = $params->get('btntext');
$btnurl = $params->get('btnurl');

?>

<div class="banner" <?php if ($params->get('backgroundimage')) : ?>
	style="background-image:url(
	<?php echo $params->get('backgroundimage'); ?>)"
	<?php endif; ?> >
	<div class="banner-image">
		<img class="<?php echo $jn_holder; ?>" data-ratio="<?php echo $ratio; ?>" src="<?php echo $image; ?>" alt="main-banner">
		<div class="caption item-<?php echo $n; ?>">
			<?php if($text1): ?>
			<div class="text1">
				<?php echo $text1; ?>
			</div>
			<?php endif; ?>
			<?php if($text2): ?>
			<div class="text2">
				<?php echo $text2; ?>
			</div>
			<?php endif; ?>
			<?php if($btntext): ?>
			<a class="btn-style-1" href="<?php echo JRoute::_(" index.php?Itemid={$btnurl}");
				?>" rel="alternate">
				<?php echo $btntext; ?></a>
			<?php endif; ?>
		</div>
	</div>

</div>