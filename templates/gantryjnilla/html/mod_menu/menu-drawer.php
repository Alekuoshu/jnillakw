<?php
/**
 * @copyright	 Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license		 GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */



defined('_JEXEC') or die;

// make this override filename independent
$fileName = pathinfo(__FILE__);
$fileName = $fileName["filename"];
$moduleclass_sfx = trim(htmlspecialchars($params->get('moduleclass_sfx')));
$uid = uniqid();

// Note. It is important to remove spaces between elements.
?>
<?php ob_start(); ?>
<?php // The menu class is deprecated. Use nav instead. ?>
<ul class="nav menu-vertical menu<?php echo $class_sfx;?>"<?php
	if ($params->get('tag_id') != null)
	{
		echo ' id="'.$params->get('tag_id').'"';
	}
?>><?php
	foreach ($list as $i => $item) :
		$class = "";
		if ($item->id == $active_id)
		{
			$class .= ' current';
		}

		if (in_array($item->id, $path))
		{
			$class .= ' active';
		}
		elseif ($item->type == 'alias')
		{
			$aliasToId = $item->params->get('aliasoptions');
			if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
			{
				$class .= ' active';
			}
			elseif (in_array($aliasToId, $path))
			{
				$class .= ' alias-parent-active';
			}
		}

		if ($item->type == 'separator')
		{
			$class .= ' divider';
		}

		if ($item->deeper)
		{
			$class .= ' deeper';
		}

		if ($item->parent)
		{
			$class .= ' parent';
		}

		if (!empty($class))
		{
			$class = ' class="'.trim($class) .'"';
		}

		echo '<li'.$class.'>';

		// Render the menu item.
		switch ($item->type) :
			case 'separator':
			case 'url':
			case 'component':
			case 'heading':
			require JModuleHelper::getLayoutPath('mod_menu', $fileName.'_'.$item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', $fileName.'_url');
				break;
		endswitch;

		// The next item is deeper.
		if ($item->deeper)
		{
			echo '<ul>';
		}
		// The next item is shallower.
		elseif ($item->shallower)
		{
			echo '</li>';
			echo str_repeat('</ul></li>', $item->level_diff);
		}
		// The next item is on the same level.
		else
		{
			echo '</li>';
		}
	endforeach;
?></ul>
<?php $buffer = ob_get_clean(); ?>

<?php //output menu inside the collapsible structure ?>
<div class="menu-drawer <?php echo $moduleclass_sfx; ?>">
	<div class="toggle" data-toggle="collapse" data-target="#drawer-<?php echo $uid; ?>">
		<span class="btn drawer-button"><span class="icon-align-justify"></span></span> <span class="btn btn-link drawer-label"><?php echo JText::_('TPL_GANTRYJNILLA_MENU'); ?></span>
	</div>

	<div id="drawer-<?php echo $uid; ?>" class="collapse out">
		<div class="drawer">
			<?php echo $buffer; ?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
