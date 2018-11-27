<?php
// no direct access
defined('_JEXEC') or die();
$buffer = array();
?>

<div class="news<?php echo $moduleclass_sfx; ?>">
	<?php foreach ($list as $item): ?>
	<?php
	ob_start();
	$link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid));
	?>
	<div class="news-item">
		<a href="<?php echo $link; ?>">
			<div class="image-container">
				<?php echo JLayoutHelper::render('jnilla.article-intro-image',
				array(
				'params' => $item->params,
				'item' => $item,
				'attr'   => 'class="jn-holder" data-ratio="tv"')); ?>
			</div>
		</a>
		<a href="<?php echo $link; ?>">
			<h4 class="news-title">
				<?php echo $item->title; ?>
			</h4>
		</a>
		<p class="introtext">
			<?php echo JHtml::_('string.truncate', strip_tags($item->introtext), 200); ?>
		</p>
		<a class="link" href="<?php echo $link; ?>">
			Leer más
		</a>
	</div>
		<?php $buffer[] = ob_get_clean();?>
		<?php endforeach;?>
		<?php echo JLayoutHelper::render('jnilla.gridify', array('cols' => 3, 'items' => $buffer)); ?>
</div>