<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 * @credits     Check credits.html included in this package or repository for a full list of credits
 */


defined('JPATH_BASE') or die;

// init
$cols = $displayData["cols"]; if($cols < 1 || $cols > 12) throw new Exception('invalid parameter');
$items = $displayData["items"]; if(!$cols) throw new Exception('invalid parameter');
$n = 0;
$span = "span".round(12/$cols);
?>
<?php foreach ($items as $item) : ?>
	<?php $n++; ?>
	<?php if($n == 1) : ?>
		<div class="row-fluid">
	<?php endif; ?>
	<div class="<?php echo $span ?>"><?php echo $item; ?></div>
	<?php if($n == $cols) : ?>
		</div>
		<?php $n = 0; ?>
	<?php endif; ?>
<?php endforeach; ?>
<?php if($n > 0) echo "</div>"; ?>


