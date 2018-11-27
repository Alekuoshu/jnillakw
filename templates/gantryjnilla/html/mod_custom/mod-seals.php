<?php
/**
* @package     Joomla.Site
* @subpackage  mod_custom
*
* @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;
// get custom fields
$list_items = $params->get('list_items');
?>
<div class="custom<?php echo $moduleclass_sfx; ?>" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?> >
	<div class="images-container">
		<?php foreach ($list_items as $item) : ?>
			<img src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>">
		<?php endforeach; ?>
	</div>
</div>
