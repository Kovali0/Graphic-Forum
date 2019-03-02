<html>
	<?php
		session_start();
		if($_SESSION['user']){
		}
		else{
			header("location: index.php");
		}
	$currentuser = $_SESSION['user'];
	?>
    <head>
		<link rel="stylesheet" type="text/css" href="application.css">
        <ul>
			<li><a href="home.php">ArtA Forge</a></li>
			<li><a href="uploadart.php">New art</a></li>
			<li><a href="mygallery.php">My Gallery</a></li>
			<li style="float:right"><a class="active" href="logout.php">Logout</a></li>
			<li style="float:right"><a class="active" href="#about">Profile</a></li>
		</ul>
    </head>
	
    <body>
        <div class="MainBox" align="center">
			<?php
				echo '<div class="textBox" align="center">';
					echo "<p>Let's see waht is the new in the main gallery ".$currentuser."! :D</p>";
				echo '</div>';
				
				$images = glob("arts/*.*");
				usort($images, create_function('$b,$a', 'return filemtime($a) - filemtime($b);'));
				mysql_connect("localhost", "root","") or die(mysql_error());
				mysql_select_db("forum_g_db") or die("Cannot connect to database");
				for($i=0;$i<12;$i++){
					if($i%4==0){
						echo '<div class="galleryRow" height="200">';
					}
					$imageFileType = strtolower(pathinfo($images[$i],PATHINFO_EXTENSION));					
					$artTitle = basename($images[$i], ".".$imageFileType);
					$query = mysql_query("SELECT * from arts WHERE art_file='$artTitle'");
					$row = mysql_fetch_assoc($query);
					$author = $row['author'];
					$note = $row['note'];
					echo '<div class="card">';
						echo'<form action="showart.php" method="post">';
							//echo '<img src="'.$images[0].'" width="250" height="300" style="width:100%"/>';
							echo '<input type="hidden" name="id" value="'.$images[$i].'">';
							echo '<input type="image" src="'.$images[$i].'" name="sub" width="250" height="300" style="width:100%"/>';
						echo'</form>';
						echo'<div class="cardcontext">';
							echo'<p>Author: '.$author.'</p>';
							echo'<p>Note: '.$note.'</p>';
						echo'</div>';
					echo' </div>';
					if($i%4==3) {
						echo'</div>';
					}
				}
			?>
		</div>
	</body>
</html>		