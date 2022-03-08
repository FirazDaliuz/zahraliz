<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
<div id="register">
<img src="media/logo.png">
<form method="POST" action="script/acccreate.php">
	<input type="text" name="UserID" placeholder="Username" id="u"><br>
	<input type="text" name="Name" placeholder="Real Name" id='u'><br>
	<input type="text" name="Password" placeholder="Password" id="p"><br>
	<input type="text" name="PhoneNum" placeholder="Phone Number" id="n"><br>
	<input type="email" name="Email" placeholder="Email" id="e"><br>
	<input type="text" name="Address" placeholder="Address" id="a"><br>
	<input type="submit" name="submit" value="Register">
	<input type="reset" name="reset">
</form>
<center>
	<a href="index.php">Kembali ke halaman Login</a>
</center>
</div>
</body>
</html>