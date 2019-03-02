<?php
	$dirname = "arts/";
	$images = glob($dirname."*.jpeg");
	
	foreach($images as $image) {
		echo '<img src="'.$image.'" /><br />';
	}
?>