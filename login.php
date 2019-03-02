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
			<h2>Login</h2>
			<form action="checklogin.php" method="post">
				Enter Username: <input type="text" name="username" required="required"/> <br/>
				Enter Password: <input type="password" name="password" required="required" /> <br/>
				<input type="submit" value="Login"/>
			</form>
		</div>
	</body>
</html>