<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//get list_items params
$interval = $params->get('interval');
$btntext = $params->get('btntext');
$btnurl = $params->get('btnurl');
$interval = $interval*1000;
$uid = "slider-".uniqid();
$n = -1;

?>

<div class="testimonios<?php echo $moduleclass_sfx; ?>" <?php if ($params->get('backgroundimage')) : ?>
    style="background-image:url(
    <?php echo $params->get('backgroundimage'); ?>)"
    <?php endif; ?> >
    <div id="<?php echo $uid; ?>" class="carousel slide">

        <div class="carousel-inner">
            <?php foreach ($list as $item) : ?>
            <?php $n++; ?>
            <div class="item <?php if($n==0) echo " active"; ?>">
                <div class="row-fluid">
                    <div class="span3">
                        <?php echo JLayoutHelper::render('jnilla.article-intro-image',
					array(
							'params' => $item->params,
							'item' => $item,
							'attr' => 'class="jn-holder jn-holder-block" data-ratio="box"')); ?>
                    </div>
                    <div class="span9">
                        <p class="testimonio"><?php echo JHtml::_('string.truncate', strip_tags($item->introtext), 300); ?></p>
                        <h4 class="cliente"><?php echo $item->title; ?></h4>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <a class="left carousel-control" href="<?php echo " #$uid"; ?>" data-slide="prev"><img src='images/arrow2-left.png'	alt='arrow-left'></a>
		<a class="right carousel-control" href="<?php echo " #$uid"; ?>" data-slide="next"><img src='images/arrow2-right.png' alt='arrow-right'></a>
    </div>

    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $('<?php echo "#$uid"; ?>').carousel({
                    interval: <?php echo $interval; ?>,
                    pause: false
                });
            });
        })(jQuery);
    </script>
</div>
<a class="btn-style-2" href="<?php echo JRoute::_("index.php?Itemid={$btnurl}");
 ?>" rel="alternate"><?php echo $btntext; ?></a>