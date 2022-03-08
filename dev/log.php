<?php
 include "../script/temp.php";
 include '../script/db/dbconfig.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="banner">
	<img src="../media/logo.png" id="bannerii">
	<img id="banneri" src="../media/NBANNER.png">
	<img src="../media/logo.png" id="bannerii">
</div>
<div id="nav">
<ul>
	<li><a href="home.php">Home</a></li>
	<li><a href="design.php">Design</a></li>
	<li><a href="order.php">Order</a></li>
	<li><a href="log.php">Log</a></li>
	<li><a href="index.php">Keluar</a></li>
</ul>
</div>
<div id="content">
	<div id="userlog">
		<center>
		<div id="fontlog">
			<?php
				$userlog=mysqli_query($conn,"select count(*) from user");
				$userlogarr=mysqli_fetch_array($userlog);
				echo $userlogarr[0];
			?>
		</div>
		pengguna
		</center>
	</div>
	<div id="patternlog">
		<center>
		<div id="fontlog">
			<?php
				$patternlog=mysqli_query($conn,"select count(*) from pattern");
				$patternlogarr=mysqli_fetch_array($patternlog);
				echo $patternlogarr[0];
			?>
		</div>
		pattern
		</center>
	</div>
	<div id="tipslog">
		<center>
		<div id="fontlog">
			<?php
				$tipslog=mysqli_query($conn,"select count(*) from tips");
				$tipslogarr=mysqli_fetch_array($tipslog);
				echo $tipslogarr[0];
			?>
		</div>
		tips
		</center>
	</div>
	<div id="orderslog">
		<center>
		<div id="fontlog">
			<?php
				$orderslog=mysqli_query($conn,"select count(*) from orders");
				$orderslogarr=mysqli_fetch_array($orderslog);
				echo $orderslogarr[0];
			?>
		</div>
		tempahan
		</center>
	</div>
</div>
<div id="footer">&copy Copyright by Firdaus bin Razali</div>
</body>
</html>