<?php
// no direct access
defined('_JEXEC') or die;
?>
<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="page-header"> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
<?php endif; ?>
<?php
foreach ($this->intro_items as $item)
{
	$itemCaption = "<h4>{$item->title}-lorem ipsum</h4><p>lorem ipsum dolor sit amed</p>";
	$itemContent = $item->introtext." ".$item->fulltext;
	$options["elements"][] = array("itemContent" => $itemContent, "itemCaption" => $itemCaption);
}
echo JLayoutHelper::render("jnilla.bootstrap.carousel", $options);
?>
