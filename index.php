<?php
session_start();
unset($_SESSION);
//unset($_SESSION['templogin']);
//unset($_SESSION['user']);
?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div id="login">
<img src="media/logo.png">
<form method="POST" action="script/connect.php">
	<input type="text" name="ID" placeholder="Username" id="un"><br>
	<input type="password" name="Pass" placeholder="Password" id="p"><br>
	<p id="f"><a href="forgot.php">Forgot Password?</a>
	<input type="checkbox" onclick="showPass()">Show Password</p>
	<input type="submit" name="submit" value="Login">
	<input type="reset" name="reset" value="Reset"><br>
	<a href="register.php" id="r">Register</a>
</form>
</div>
</body>
</html>
<script type="text/javascript">
	function showPass() {
		var x = document.getElementById('p');
		if (x.type === "password") {
			x.type = "text";
		}
		else{
			x.type = "password";
		}
	}
</script>