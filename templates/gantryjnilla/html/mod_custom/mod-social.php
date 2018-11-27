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
$social_items = $params->get('list_items');
?>
<?php //Social Media ?>
<?php if($social_items): ?>
	<div class="social-media">
		<ul class="nav menu">
			<?php foreach ($social_items as $key => $social): ?>
				<?php
				switch ($social->social_name) {
					case 'facebook':
					$icon_social = 'fa fa-facebook-f';
					break;
					case 'instagram':
					$icon_social = 'fa fa-instagram';
					break;
					case 'twitter':
					$icon_social = 'fa fa-twitter';
					break;
					case 'google':
					$icon_social = 'fa fa-google-plus-g';
					break;
					case 'linkedin':
					$icon_social = 'fa fa-linkedin-in';
					break;
					case 'pinterest':
					$icon_social = 'fa fa-pinterest-p';
					break;
					case 'yelp':
					$icon_social = 'fa fa-yelp';
					break;
				}
				?>
				<li><a class="item" href="<?php echo $social->social_url; ?>" target="_blank" rel="nofollow" title="<?php echo $social->social_name; ?>"><i class="<?php echo $icon_social; ?>" aria-hidden="true"></i></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php else: ?>
	<p>There aren't any social item created</p>
<?php endif; ?>
