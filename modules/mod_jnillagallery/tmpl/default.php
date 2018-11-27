<?php
/**
* @package     jnillagallery
* @subpackage  mod_jnillagallery
*
* @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

$images = $params->get('gallery');
$gallery = $images;
$layout = $params->get('jnlayout');
$type = $params->get('type');
$jnbox = $params->get('jnbox');
$caption = $params->get('caption');
$style_caption = $params->get('style_caption');
$style_slider3 = $params->get('style_slider3');
$numPages = $params->get('num_item_pages');
$colsNum = $params->get('cols_number');
$infiniteScroll = $params->get('infinite_scroll');
$spaceBetween = $params->get('space_images');
$interval = $params->get('interval');


if ($type == 'videos') {
  //get list_videos params
  $list_videos = $params->get('list_videos');
  //encode and decode it
  $list_videos = json_encode($list_videos,true);
  $videoencoded 	 = json_decode($list_videos,true);
  //iterar list and change titles from array
  foreach ($videoencoded as $clave => $list) {

   foreach ($list as $key => $item) {
  	$title = array();
   	$title = explode(' ', $list['title']);
  	$title = implode('-', $title);
   	$list['title']=$title;
   }
   $videoencoded[$clave]=$list;

  }
  $videoencoded = json_encode($videoencoded,true);
}

//for featured videos
if ($layout == 'fvideos') {
  //get list_videos params
  $list_fvideos = $params->get('list_fvideos');
  //encode and decode it
  $list_fvideos = json_encode($list_fvideos,true);
  $fvideoencoded 	 = json_decode($list_fvideos,true);
  //iterar list and change titles from array
  foreach ($fvideoencoded as $clave2 => $list2) {

   foreach ($list2 as $key2 => $item2) {
  	$title2 = array();
   	$title2 = explode(' ', $list2['title']);
  	$title2 = implode('-', $title2);
   	$list2['title']=$title2;
   }
   $fvideoencoded[$clave2]=$list2;

  }
  $fvideoencoded = json_encode($fvideoencoded,true);
}


?>

<div class="container-gallery">

		<?php  echo JHtml::_('content.prepare', '{jnillagallery}'.$gallery.' [layout:'.$layout.',type:'.$type.',jnbox:'.$jnbox.',numpages:'.$numPages.',cols:'.$colsNum.',infinitescroll:'.$infiniteScroll.',spaced:'.$spaceBetween.',interval:'.$interval.',caption:'.$caption.',stylecaption:'.$style_caption.',style:'.$style_slider3.',listvideos:'.$videoencoded.',listfvideos:'.$fvideoencoded.']{/jnillagallery}');
		?>

</div>
