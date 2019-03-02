<?php
	session_start();
		if($_SESSION['user']){
		}
		else{
			header("location: index.php");
		}
		$currentuser = $_SESSION['user'];
		
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$commentcontent = mysql_real_escape_string($_POST['commentcontent']);
		$art_id = mysql_real_escape_string($_POST['art_id']);
		mysql_connect("localhost", "root","") or die(mysql_error());
		mysql_select_db("forum_g_db") or die("Can not connect to database");
		$query = mysql_query("SELECT comment_id from comments WHERE art_id='$art_id'");
		if($query == null){
			$comment_id = 0;
		}else{
			$row = mysql_fetch_assoc($query);
			$tmp = $row['comment_id'];
			$comment_id = $tmp + 1;
		}
		echo mysql_query("INSERT INTO comments (comment_id, art_id, author, content) VALUES ('$comment_id','$art_id','$currentuser','$commentcontent')");
		Print '<script>alert("Successfully Commented!");</script>';
		Print '<script>window.location.assign("home.php");</script>';
	}
?>