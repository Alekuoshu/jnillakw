<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 * Edited By Alekuoshu, now excludes working!!!
 */


defined('_JEXEC') or die;
jimport ( 'joomla.filesystem.folder' );
jimport ( 'joomla.filesystem.file' );

/**
 * Helper for plg_system_jnilla
 */
class plgSystemJnillaHelper
{
	/**
	 * find and update all the autoloader.less files
	 */
	public static function updateLessAutoloaders(){
		$app = JFactory::getApplication();
		$template = $app->getTemplate();
		$path = JPATH_SITE . "/templates/$template/less/";
		$folders = JFolder::listFolderTree($path, '', 20);

		foreach($folders as $folder){
			$folderPath = $folder["fullname"];

			if(JFile::exists("$folderPath/autoloader.less")){
				// List less files
				$files = JFolder::files($folderPath, '.less');

				// Remove autoloader.less
				$files = array_diff($files, array("autoloader.less"));

				// Apply ordering if exist
				$files = self::applyOrdering($folderPath, $files);

				// Apply excludes if exist
				$files = self::applyExcludes($folderPath, $files);

				// Compile autoloader file
				if (count($files)){
					$content = "";
					foreach($files as $file){
						$content .= "@import \"$file\";\n";
					}

					$oldContent = file_get_contents("$folderPath/autoloader.less");

					if ($oldContent != $content){
						JFile::write("$folderPath/autoloader.less", $content);
					}
				}
			}
		}
	}


	/**
	 * import and mix the files inside the js-importer folder
	 */
	public static function compileJsAutoloader(){
		// declarations
		$app = JFactory::getApplication();
		$template = $app->getTemplate();
		$path = JPATH_SITE . "/templates/$template/js/autoloader/";

		if(JFolder::exists($path)){
			// List js files
			$files = JFolder::files($path, '.js');

			// Remove autoloader.js
			$files = array_diff($files, array("autoloader.js"));

			// Apply ordering if exist
			$files = self::applyOrdering($path, $files);

			// Apply excludes if exist
			$files = self::applyExcludes($path, $files);

			// Compile autoloader file
			if (count($files)){
				$content = "";
				foreach($files as $file){
					if($file == "autoloader.js") continue;

					$content .= "\n\n\n";
					$content .= "// File: $file\n";
					$content .= "\n";
					$content .= trim(file_get_contents("$path/$file"))."\n\n\n";
				}

				if(JFile::exists("$path/autoloader.js")){
					$oldContent = file_get_contents("$path/autoloader.js");
				}else{
					$oldContent = "";
				}

				if ($oldContent != $content){
					JFile::write("$path/autoloader.js", $content);
				}
			}
		}
	}


	/**
	 * Get autoloader ordering and apply it to file array
	 */
	private static function applyOrdering($path, $files){
		// Get files ordering if exist
		if(JFile::exists("$path/autoloader-ordering.txt")){
			// Get ordering elements
			$orderingItems = file_get_contents("$path/autoloader-ordering.txt");
			$orderingItems = explode("\n", $orderingItems);

			// Check if ordering files exist
			foreach ($orderingItems as $orderingItem) {
				if(JFile::exists("$path/$orderingItem")){
					$orderingFiles[] = $orderingItem;
				}
			}

			// Remove ordering elements from files
			if(count($orderingFiles)){
				$files = array_diff($files, $orderingFiles);
			}

			// Prepend elements
			$files = array_merge($orderingFiles, $files);
		}

		return $files;
	}


	/**
	 * Get autoloader excludes and apply it to file array
	 */
	private static function applyExcludes($path, $files){
		// Get files excludes if exist
		if(JFile::exists("$path/autoloader-excludes.txt")){
			// Get exclude elements
			$excludeItems = file_get_contents("$path/autoloader-excludes.txt");
			$excludeItems = explode("\n", $excludeItems);

			// Check if exclude files exist
			foreach ($excludeItems as $key => $excludeItem) {
				if(JFile::exists("$path/$excludeItem")){
					$excludeFiles[$key+1] = trim($excludeItem);
				}
			}
			// Remove exclude elements from files
			if(count($excludeFiles)){
				$files = array_diff($files, $excludeFiles);
			}
		}

		return $files;
	}



	/**
	 * Enable development mode
	 */
	public static function setDevelopmentModeParam($enable){
		// Normalize value
		if($enable === true){
			$enable = "1";
		}else{
			$enable = "0";
		}

		// Get stored params
		$db = JFactory::getDbo();
		$db->setQuery("
			SELECT params
			FROM #__extensions
			WHERE name = 'plg_system_jnilla'
		;");
		$db->query();
		$result = $db->loadAssoc();

		// Parse params
		$params = $result['params'];
		$params = json_decode($params);

		// Set new value
		$params->development_mode = $enable;

		// Encode params
		$params = json_encode($params);
		$params = $db->quote($params);

		// Update params
		$db->setQuery("
			UPDATE #__extensions
			SET params = $params
			WHERE name = 'plg_system_jnilla'
		;");
		$db->query();
	}

}