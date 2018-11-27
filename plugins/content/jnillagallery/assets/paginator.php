<?php
/**
* @package     Joomla.Site
* @copyright   Copyright (C) 2017 - 2020 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;


?>

<?php

function paginator($v, $l, $p, $grid, $spaced) {

	// DEFINE THE QUANTITY OF PAGES
	$pages = ceil(count($v) / $l);

	// CONDITION OF START
	$init = ($p-1)*$l;

	// CONDITION OF FINAL
	$end = $p*$l;

	$cols = $grid;
	if($cols <= 1) $cols = 2;
	$items = $v;
	$n = 0;

	//get space between images
	if ($spaced == true) {
		$span = "span".round(12/$cols);
	} else {
		$span = "jn-span-".round(12/$cols);
	}

	for ($i=$init; $i<$end; $i++) {
		if (isset($v[$i])) {

			$n++;
			if($n == 1) {
				//get space between images
				if ($spaced == true) {
					echo	"<div class='row-fluid'>";
				} else {
					echo	"<div class='jn-row-fluid'>";
				}
			}
			echo "<div class='$span' id=\"item-$i\">$v[$i]</div>";
			if($n == $cols) {
				echo	"</div>";
				$n = 0;
			}
		}else{
			break;
		}
	}
	if($n > 0) echo "</div>";


	// LIST THE PAGES
	echo '<div id="paginator" class="pagination">';
	if ($p>1)
	echo "<a title='Previous' href=\"index.php?p=" . ($p-1) . "\">Prev Page</a>&nbsp;-&nbsp;";

	for ($i=1; $i<=$pages; $i++) {
		if ($i == $p)
		echo "<strong>$i</strong>&nbsp;";
		else
		echo "<a href=\"index.php?p=$i\">$i</a>&nbsp;";
	}

	if ($p<$pages) {
		echo "&nbsp;-&nbsp;<a title='Next' href=\"index.php?p=" . ($p+1) . "\">Next Page&nbsp;</a>";
		echo '</div>';
		return;
	}

}


?>
