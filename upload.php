<?php
	session_start();
		if($_SESSION['user']){
		}
		else{
			header("location: index.php");
		}
	$currentuser = $_SESSION['user'];
	
	$artName = $_POST['artName'];
	$target_dir = "arts/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}

	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}

	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$conn = mysql_connect("localhost", "root","") or die(mysql_error());
		mysql_select_db("forum_g_db") or die("Can not connect to database");
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$query = mysql_query("SELECT * from users WHERE username='$currentuser'");
		$tero = mysql_query("INSERT INTO arts (author, art_file) VALUES ('$currentuser','$artName')");
		if($tero == false){
			die('Invalid query: ' . mysql_error());
		}
	}
		
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$artName.".".$imageFileType)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
?>
<meta http-equiv="refresh" content="0;URL=home.php" /> 
