<html>
	<head>
		<link rel="stylesheet" type="text/css" href="application.css">
        <ul>
			<li><a href="home.php">ArtA Forge</a></li>
			<li><a href="#news">News</a></li>
			<li><a href="#contact">Contact</a></li>
			<li style="float:right"><a class="active" href="register.php">Register</a></li>
			<li style="float:right"><a class="active" href="login.php">Login</a></li>
		</ul>
    </head>
	<body>
		<div class="loginBox" align="center">
			<h2>Join ArtAForge</h2>
			<form action="register.php" method="post">
				Enter Username: <input type="text" name="username" required="required" /> <br/>
				Enter Email: <input type="text" name="email" required="required" /> </br>
				Enter Password: <input type="password" name="password" required="required" /> <br/>
				<input type="submit" value="Register"/>
			</form>
		</div>
	</body>
</html>

<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$hashed_password = hash('sha512', $password);
		$email = mysql_real_escape_string($_POST['email']);
		$bool = true;
		mysql_connect("localhost", "root","") or die(mysql_error());
		mysql_select_db("forum_g_db") or die("Can not connect to database");
		$query = mysql_query("Select * from users");
		while($row = mysql_fetch_array($query))
		{
			$table_users = $row['username'];
			if($username == $table_users)
			{
				$bool = false;
				Print '<script>alert("Username has been taken! Try again.");</script>';
				Print '<script>window.location.assign("register.php");</script>';
			}
		}
		if($bool)
		{
			mysql_query("INSERT INTO users (username, email, password) VALUES ('$username','$email','$hashed_password')");
			Print '<script>alert("Successfully Registered!");</script>';
			Print '<script>window.location.assign("register.php");</script>';
		}
	}
?>