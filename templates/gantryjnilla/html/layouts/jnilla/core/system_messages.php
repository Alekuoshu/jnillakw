<?php
defined('JPATH_BASE') or die;

global $gantry;
$group = $displayData["group"]; if(!$group) return;
?>
<?php if (JFactory::getApplication()->getMessageQueue() && $gantry->get('systemmessages-enabled')) : ?>
	<?php if ($group == $gantry->get('systemmessages-location', 'jn-before')) : ?>
		<jdoc:include type="message" />
	<?php endif; ?>
<?php endif; ?>


