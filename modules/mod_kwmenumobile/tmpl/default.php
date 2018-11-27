<?php
/**
* @package     kwmenumobile
* @subpackage  mod_kwmenumobile
*
* @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

// loading some scripts
$doc->addStyleSheet("media/mod_kwmenumobile/css/default.css");
$doc->addScript("media/mod_kwmenumobile/js/default.js");

?>
<div class="mod_kwmenumobile">

  <div class="menu-mobile-container">
    <div class="header-menu">
      <div class="row-fluid">
        <div class="span4">
          <div class="panel-logo">
            <div class="mod-logo jn-block">
              <a href="<?php  echo JHtml::_('content.prepare', '{jnillavars}base_url{/jnillavars}'); ?>" rel="home">
                <img src="<?php echo $logo; ?>" alt="Logo">
              </a>
            </div>
          </div>
        </div>
        <div class="span8">
          <div class="panel-toggle">
            <i class="fa fa-reorder"> </i>
          </div>
        </div>
      </div>
    </div>
    <div class="body-menu">
      <div class="jn-block mod-menu-main-mobile">
        <?php echo $menu; ?>
      </div>
    </div>
  </div>

</div>