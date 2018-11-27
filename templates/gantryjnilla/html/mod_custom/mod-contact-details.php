<?php
/**
* @package     Joomla.Site
* @subpackage  mod_custom
*
* @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

//get custom params
$address = $params->get('address');
$link_address = $params->get('link_address');
$phone1 = $params->get('phone1');
$phone2 = $params->get('phone2');
$email = $params->get('email');
$horario = $params->get('horario');
?>

<div class="custom<?php echo $moduleclass_sfx; ?>">
    <ul>
        <?php if($link_address): ?>
        <li><i class="fa fa-map-marker"></i>
            <a href="<?php echo $link_address; ?>" target="_blank">
                <address>
                    <?php echo JHtml::_('string.truncate', strip_tags($address), 0); ?>
                </address>
            </a>
        </li>
        <?php endif; ?>

        <?php if($phone1): ?>
        <li><i class="fa fa-phone"></i> <a href="tel:<?php echo $phone1; ?>">
                <?php echo $phone1; ?></a> </li>
        <?php endif; ?>

        <?php if($phone2): ?>
        <li><i class="fa fa-mobile-phone"></i> <a href="tel:<?php echo $phone2; ?>">
                <?php echo $phone2; ?></a> </li>
        <?php endif; ?>

        <?php if($email): ?>
        <li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $email; ?>">
                <?php echo $email; ?></a> </li>
        <?php endif; ?>

        <?php if($horario): ?>
        <li><i class="fa fa-clock-o"></i>
            <?php echo $horario; ?>
        </li>
        <?php endif; ?>
    </ul>
</div>