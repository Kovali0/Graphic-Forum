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
			<li style="float:right"><a class="active" href="profile.php">Profile</a></li>
		</ul>
    </head>
    <body>
		<div class="textBox" align="center">
			<?php 
				$path = $_POST['id'];
				$target_dir = "arts/";
				$target_file = $target_dir.$path;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$artTitle = basename($path, ".".$imageFileType);
				echo  $artTitle;
				mysql_connect("localhost", "root","") or die(mysql_error());
				mysql_select_db("forum_g_db") or die("Can not connect to database");
				$query = mysql_query("SELECT art_id from arts WHERE art_file='$artTitle'");
				$row = mysql_fetch_assoc($query);
				$art_id = $row['art_id'];
			?>
		</div>
		<div class="artContainer" align="center" >
			<div class="artBox" align="center" >
				<?php
					//$art = $_GET['img'];
					echo '<img src="'.$_POST['id'].'"/>';
				?>
			</div>
			<div class="commentSection" align="center">
				<?php
					$querycomments = mysql_query("SELECT * from comments WHERE art_id='$art_id'");
					$commentscontent = Array();
					$commentauthor = Array();
					$commentsnumber = mysql_num_rows($querycomments);
					//while ($row = mysql_fetch_assoc($querycomments)){
					//	$commentscontent = $row['content'];
					//	$commentauthor = $row['author'];
					//}
					$i=0;
					$j=0;
					while($i<$commentsnumber){
						$querycomments = mysql_query("SELECT * from comments WHERE comment_id='$i' AND art_id='$art_id'");
						$row = mysql_fetch_assoc($querycomments);
						$commentscontent = $row['content'];
						$commentauthor = $row['author'];
						echo '<div class="comment">';
							echo'<p>Author: '.$commentauthor.'</p>';
							echo'<p>Comment: '.$commentscontent.'</p>';
						echo '</div>';
						$i++;
					}
				?>
			</div>
			<div class="commentForm">
				<form action="commentadd.php" method="post">
					<div class="input-row">
						<?php echo '<input type="hidden" name="art_id" id="artId" value="'.$art_id.'" />' ?>
						<input type="hidden" name="comment_id" id="commentId" placeholder="Name" /> 
						<textarea class="input-field" type="text" name="commentcontent"
							id="commentcontent" placeholder="Add a Comment">  </textarea>
					</div>
					<div>
						<input type="submit" value="Publish comment"/>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>