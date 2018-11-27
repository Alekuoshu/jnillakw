<?php
defined('JPATH_BASE') or die;

// init
global $gantry;
$group = $displayData["group"]; if(!$group) return;
$rows  = $displayData["rows"]; if(!$rows) $rows = 4;
$tag  = $displayData["tag"]; if(!$tag) $tag = 'div';
$noContainer  = $displayData["noContainer"];
$hasMods = false;
for ($row=1; $row<=$rows; $row++)
{
	if($gantry->countModules("$group-$row"))
	{
		$hasMods = true;
		break;
	}
}

echo JLayoutHelper::render('jnilla.core.render_system_messages', array('group' => $group));

if(!$hasMods) return;
?>
<<?php echo $tag; ?> id="<?php echo "$group"; ?>" class="jn-group">
	<?php  for ($row=1; $row<=$rows; $row++) : ?>
		<?php if($gantry->countModules("$group-$row")) : ?>
			<div id="<?php echo "$group-$row"; ?>" class="jn-group-row">
				<?php if(!$noContainer) :?><div class="container"><?php endif; ?>
					<div class="jn-row-fluid">
						<?php echo $gantry->displayModules("$group-$row",'standard','standard'); ?>
						<div class="clearfix"></div>
					</div>
				<?php if(!$noContainer) :?></div><?php endif; ?>
			</div>
		<?php endif; ?>
	<?php endfor; ?>
</<?php echo $tag; ?>>
