<?php
	$id = $_GET['id'];
	$images = glob("arts/*.*");
	$uploaddir = 'arts/';
	usort($images, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));
	
	for($i=0; $i<7||$i<count($images); $i++){
		$image = $images[$i];
		//echo '<img src="'.$image.'"/>';
		//$art = $images[$i];
		
	}
	//echo '<img src="'.$images[$id].'"/>';
	//header("Content-Type: " . $image);
    //$contents = file_get_contents($uploaddir . $name);
    //echo $contents;
	//				<img src="php showmaingallery.php?id=1" width="175" height="200" />
	echo $images[1];
?>
