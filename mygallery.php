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
					echo "<p>Ur gallery is awasome! :o</p>";
				echo '</div>';
				
				$images = glob("arts/*.*");
				usort($images, create_function('$b,$a', 'return filemtime($a) - filemtime($b);'));
				mysql_connect("localhost", "root","") or die(mysql_error());
				mysql_select_db("forum_g_db") or die("Cannot connect to database");
				$queryauthor = mysql_query("SELECT art_file from arts WHERE author='$currentuser'");
				$artsnumber = mysql_num_rows($queryauthor);
				$authorarts = Array();
				while ($row = mysql_fetch_assoc($queryauthor)){
					$authorarts[] = $row['art_file'];
				}
				$i=0;
				$j=0;
				while($i<$artsnumber && $j<count($images)){
					$imageFileType = strtolower(pathinfo($images[$j],PATHINFO_EXTENSION));					
					$artTitle = basename($images[$j], ".".$imageFileType);
					$tmp1 = (string)$authorarts[$i];
					$tmp2 = (string)$artTitle;
					if($tmp1==$tmp2){
						if($i%4==0){
							echo '<div class="galleryRow" height="200">';
						}
						$query = mysql_query("SELECT * from arts WHERE author='$currentuser' AND art_file='$artTitle'");
						$row = mysql_fetch_assoc($query);
						$note = $row['note'];
						echo '<div class="card">';
							echo'<form action="showart.php" method="post">';
								//echo '<img src="'.$images[0].'" width="250" height="300" style="width:100%"/>';
								echo '<input type="hidden" name="id" value="'.$images[$j].'">';
								echo '<input type="image" src="'.$images[$j].'" name="sub" width="250" height="300" style="width:100%"/>';
							echo'</form>';
							echo'<div class="cardcontext">';
								echo'<p>Author: '.$currentuser.'</p>';
								echo'<p>Note: '.$note.'</p>';
							echo'</div>';
						echo' </div>';
						if($i%4==3 || $i==$artsnumber) {
							echo'</div>';
						}
						$i++;
					}
					$j++;
					if($tmp1==$tmp2){
						$j=0;
					}
				}
			?>
		</div>
	</body>
</html>		