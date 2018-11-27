<?php
// no direct access
defined('_JEXEC') or die;
?>
<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="page-header"> <?php echo $this->escape($this->params->get('page_heading')); ?></h1>
<?php endif; ?>
<?php
foreach ($this->intro_items as $item)
{
	$accordionItems[] = array(
		'title' => $item->title,
		'content' => $item->introtext.$item->fulltext,
	);
}
echo JLayoutHelper::render("jnilla.bootstrap.accordion", array('items' => $accordionItems));
?>


