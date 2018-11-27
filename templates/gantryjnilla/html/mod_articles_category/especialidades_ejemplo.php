<?php
// no direct access
defined('_JEXEC') or die();
$buffer = array();
?>

<?php
// get category description
$db           = &JFactory::getDBO();
$categoryName = $list[0]->category_title;
$query        = "SELECT
            description
          FROM
            #__categories
          WHERE
            title = '$categoryName'";
$db->setQuery($query);
$ret      = $db->loadObject();
$category = $ret->description;

?>
<div class="description">
	<?php echo $category; ?>
</div>
<div class="especialidades<?php echo $moduleclass_sfx; ?>">
	<?php foreach ($list as $item): ?>
	<?php
ob_start();
$link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid));
?>
	<div class="item-container">
		<a class="espec" href="<?php echo $link; ?>">
			<div class="image-container">
				<?php echo JLayoutHelper::render('jnilla.article-intro-image',
			array(
				'params' => $item->params,
				'item'   => $item,
				'attr'   => 'class="jn-holder jn-holder-block" data-ratio="tv"')); ?>
				<div class="rollover">
					<h4 class="item-title">
						<?php echo $item->title; ?>
					</h4>
				</div>
			</div>
		</a>
	</div>
	<?php $buffer[] = ob_get_clean();?>
	<?php endforeach;?>
	<?php echo JLayoutHelper::render('jnilla.gridify', array('cols' => 3, 'items' => $buffer)); ?>
</div>