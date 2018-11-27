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
	$tabLabel = $item->title;
	$paneContent = $item->introtext." ".$item->fulltext;
	$options["elements"][] = array("tabLabel" => $tabLabel, "paneContent" => $paneContent);
}
echo JLayoutHelper::render("jnilla.bootstrap.tabs", $options);
?>
