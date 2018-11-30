<?php
defined('_JEXEC') or die;

// get custom fields
$introtext = $params->get('introtext');
$list_items = $params->get('list_items');

foreach ($list_items as $item){
	$tabsItems[] = array(
		'title' => $item->tab,
		'content' => $item->content_tab,
	);
}
echo '<div class="introtext">';
    echo $introtext;
echo '</div>';
echo JLayoutHelper::render("jnilla.bootstrap.tabs", array('items' => $tabsItems));



