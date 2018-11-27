<?php
/**
* @copyright   Copyright (C) 2017 koshucasweb.com.ve All rights reserved.
* @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die;

/**
* jnillagallery plugin class.
*
*/
class PlgContentJnillaGallery extends JPlugin {

	/**
	* Constructor
	*
	* @access      protected
	* @param       object  $subject The object to observe
	* @param       array   $config  An array that holds the plugin configuration
	*/
	public function __construct(& $subject, $config) {
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	public function onContentPrepare($context, &$article, &$params, $page = 0) {
		// check execution side
		$app = JFactory::getApplication();
		if($app->getName() != 'site') return;

		// imports
		jimport( 'joomla.filesystem.folder' );
		jimport( 'joomla.filesystem.file' );

		// init
		$plgParams = $this->params;

		// get some values from params
		$baseFolder = trim($plgParams->get('base_folder')); // TODO: support relative, absolute and external url in the future

		// check if base folder exist
		if (!JFolder::exists(JPATH_BASE."/".$baseFolder)) {
			echo "<script>console.log('Message from: PlgContentJnillaGallery; Error: Base folder: \"".JPATH_BASE."/".$baseFolder."\" Does not exist!')</script>";
			return false;
		}

		// find plugin tags on the given content
		$instances = array();
		$regex = '/{jnillagallery}(.*){\/jnillagallery}/iU';
		preg_match_all($regex, $article->text, $instances);

		foreach($instances[1] as $instance) {
			$instanceParams = strip_tags($instance);
			$instanceVideos = preg_replace('/\x{A0}/u', ' ', $instanceParams);
			$instanceParams = preg_replace('/\x{A0}/u', ' ', $instanceParams);
			$instanceParams = explode(" ", $instanceParams);

			// validate instance params
			if ($instanceParams[1] != ""){

				$re = '/\[(.*)\]/u';
				//get custom params
				$str = $instanceParams[1];
				preg_match($re, $str, $matches);
				$params = $matches[1];

				//layout
				$re = '/layout:\w+/u';
				preg_match($re, $params, $matches);
				$param1 = $matches[0];
				$param1 = explode(":", $param1);
				$layout = $param1[1];
				//////////////////////////////////////////////

				//numpages
				$re = '/numpages:\w+/u';
				preg_match($re, $params, $matches);
				$param2 = $matches[0];
				$param2 = explode(":", $param2);
				if ($param2[1]) $numPages = $param2[1];
				//////////////////////////////////////////////

				//infinitescroll
				$re = '/infinitescroll:\w+/u';
				preg_match($re, $params, $matches);
				$param3 = $matches[0];
				$param3 = explode(":", $param3);
				$infiniteScroll = $param3[1];
				//////////////////////////////////////////////

				//colsnumber
				$re = '/cols:\w+/u';
				preg_match($re, $params, $matches);
				$param4 = $matches[0];
				$param4 = explode(":", $param4);
				if ($param4[1] == '2') $colsNum = '2';
				if ($param4[1] == '3') $colsNum = '3';
				if ($param4[1] == '4') $colsNum = '4';
				if ($param4[1] == '5') $colsNum = '5';
				if ($param4[1] == '6') $colsNum = '6';
				//////////////////////////////////////////////

				//Space between images
				$re = '/spaced:\w+/u';
				preg_match($re, $params, $matches);
				$param5 = $matches[0];
				$param5 = explode(":", $param5);
				$spaceBetween = $param5[1];
				//////////////////////////////////////////////

				//interval to rotator
				$re = '/interval:\w+/u';
				preg_match($re, $params, $matches);
				$param6 = $matches[0];
				$param6 = explode(":", $param6);
				if ($param6[1]) $interval = $param6[1];
				//////////////////////////////////////////////

				//caption option
				$re = '/caption:\w+/u';
				preg_match($re, $params, $matches);
				$param7 = $matches[0];
				$param7 = explode(":", $param7);
				$caption = $param7[1];
				// var_dump($caption);
				//////////////////////////////////////////////

				//jnbox option
				$re = '/jnbox:\w+/u';
				preg_match($re, $params, $matches);
				$param8 = $matches[0];
				$param8 = explode(":", $param8);
				$jnbox = $param8[1];
				// var_dump($jnbox);
				//////////////////////////////////////////////

				//Style option (only slider3)
				$re = '/style:\w+/u';
				preg_match($re, $params, $matches);
				$param9 = $matches[0];
				$param9 = explode(":", $param9);
				$style = $param9[1];
				//////////////////////////////////////////////

				//Style Caption
				$re = '/stylecaption:\w+/u';
				preg_match($re, $params, $matches);
				$param10 = $matches[0];
				$param10 = explode(":", $param10);
				$stylecaption = $param10[1];
				//////////////////////////////////////////////

				//gallery type
				$re = '/type:\w+/u';
				preg_match($re, $params, $matches);
				$param11 = $matches[0];
				$param11 = explode(":", $param11);
				$type = $param11[1];
				//////////////////////////////////////////////

				//list videos
				$re = '/listvideos:{([^()]*)}/u';
				preg_match($re, $instanceVideos, $matches);
				$param12 = $matches[0];
				$param12 = explode("listvideos:", $param12);
				$videos = $param12[1];
				//////////////////////////////////////////////

				//list fvideos
				$re = '/listfvideos:{([^()]*)}/u';
				preg_match($re, $instanceVideos, $matches);
				$param13 = $matches[0];
				$param13 = explode("listfvideos:", $param13);
				$fvideos = $param13[1];
				//////////////////////////////////////////////


			}

			//get folder images
				$files = JFolder::files(JPATH_SITE."/$baseFolder".$instanceParams[0], "jpg|png|gif|jpeg|JPG|PNG");
				$galleryPath = $baseFolder.$instanceParams[0];

			ob_start();
			switch ($layout) {
				case 'default':
				include "layouts/default.php";
				break;
				case 'carousel1':
				include "layouts/carousel-1.php";
				break;
				case 'carousel2':
				include "layouts/carousel-2.php";
				break;
				case 'carousel3':
				include "layouts/carousel-3.php";
				break;
				case 'carousel4':
				include "layouts/carousel-4.php";
				break;
				case 'carousel5':
				include "layouts/carousel-5.php";
				break;
				case 'masonry':
				include "layouts/masonry.php";
				break;
				case 'rotator':
				include "layouts/rotator.php";
				break;
				case 'rotator2':
				include "layouts/rotator-2.php";
				break;
				case 'slider3':
				include "layouts/slider-3.php";
				break;
				case 'slider5':
				include "layouts/slider-5.php";
				break;
				case 'fvideos':
				include "layouts/fvideos.php";
				break;
				// default:
				// include "layouts/default.php";
				// break;
			}
			$markup = ob_get_clean();
			$article->text = preg_replace($regex, $markup, $article->text, 1);
		}


	}
}
