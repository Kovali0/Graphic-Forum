<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="application.css">
        <ul>
			<li><a href="index.php">ArtA Forge</a></li>
			<li><a href="#news">News</a></li>
			<li><a href="#contact">Contact</a></li>
			<li style="float:right"><a class="active" href="register.php">Register</a></li>
			<li style="float:right"><a class="active" href="login.php">Login</a></li>
		</ul>
    </head>
    <body>
		<div class="MainBox" align="center">
			<?php
				echo '<div class="textBox" align="center">';
					echo "<p>Welcom in Arta Forge!</p>";
					echo "<p>This is the place where u can share ur graphic project with other designers.</p>";
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