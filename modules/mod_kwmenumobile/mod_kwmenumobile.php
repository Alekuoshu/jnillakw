<?php
/**
 * KW Menu Mobile! Module for manage menus mobile
 *
 * @package    kwmenumobile
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 * @link       https://koshucasweb.com.ve
 * mod_kwmenumobile is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$entryPoint = modKwMenuMobileHelper::getModule($params);

$mid = $module->id;
$doc = JFactory::getDocument();

// get params
$layout = $params->get('layout');
$logo = $params->get('logo');
$menu = $params->get('menu');
$drawer = $params->get('drawer_direction');

require JModuleHelper::getLayoutPath('mod_kwmenumobile', $layout);
