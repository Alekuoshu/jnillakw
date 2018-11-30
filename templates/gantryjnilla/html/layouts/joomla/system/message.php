<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$msgList = $displayData['msgList'];
?>
<div id="system-message-container">
	<?php if (is_array($msgList) && !empty($msgList)) : ?>
	<div id="system-message">
		<?php foreach ($msgList as $type => $msgs) : ?>
		<?php
					switch (strtolower($type)) {
						case 'message':
							$class = 'success';
							break;
						case 'notice':
							$class = 'info';
							break;
						case 'error':
							$class = 'error';
							break;
						default:
							$class = $type;
							break;
					}
				?>
		<!-- Modal -->
		<div id="mySystemModal" class="alert alert-<?php echo $class; ?> modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<?php if (!empty($msgs)) : ?>
				<h3 class="alert-heading">
					<?php echo JText::_($type); ?>
				</h3>
				<?php endif; ?>
			</div>
			<div class="modal-body">
				<?php if (!empty($msgs)) : ?>
				<?php foreach ($msgs as $msg) : ?>
				<div class="alert-message">
					<?php echo $msg; ?>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<script type="text/javascript">
		(function ($) {
			$(document).ready(function () {
				$('#mySystemModal').modal('show');
			});
		})(jQuery);
	</script>
</div>