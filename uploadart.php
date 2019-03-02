<html>
	<?php
		session_start();
		if($_SESSION['user']){
		}
		else{
			header("location: index.php");
		}
	$user = $_SESSION['user'];
	?>
    <head>
		<link rel="stylesheet" type="text/css" href="application.css">
        <ul>
			<li><a href="home.php">ArtA Forge</a></li>
			<li><a href="uploadart.php">New art</a></li>
			<li><a href="#contact">Contact</a></li>
			<li style="float:right"><a class="active" href="logout.php">Logout</a></li>
			<li style="float:right"><a class="active" href="#about">Profile</a></li>
		</ul>
    </head>
	
	<body>
		<div class="margines" >
		<div class="loginBox" align="center">
			<form action="upload.php" method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload"><br></br>
				Enter the graphic title:
				<input type="text" name="artName" required="required">
				<input type="submit" value="Upload Image" name="submit">
			</form>
		</div>
		</div>
	</body>
</html>