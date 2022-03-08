<?php
 include "script/temp.php";
 include 'script/db/dbconfig.php';
?>
<html>
<head>
	<title>Tips</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="banner">
	<img src="media/logo.png" id="bannerii">
	<img src="media/NBANNER.png" id="banneri">
	<img src="media/logo.png" id="bannerii">
</div>
<div id="nav">
<ul>
	<li><a href="home.php">Home</a></li>
	<li><a href="showcase.php">Showcase</a></li>
	<li><a href="cart.php">Cart</a></li>
	<li><a href="tips.php">Tips</a></li>
	<li><a href="about.php">About</a></li>
	<li><a href="index.php">Keluar</a></li>
</ul>
</div>
<div id="content">
	<table id="tips">
		<?php
			$query=mysqli_query($conn,"select * from tips");
			while ($arr=mysqli_fetch_array($query)) {
				$dat=$arr[0];
				echo <<<ENDHTML
						<tr>
						<td><button id="tipsbutton" onclick="displayTips('$dat')">
					ENDHTML;
				echo $arr[1]."</button>
						<div id='".$arr[0]."' style='display:none;'>".$arr[2].$arr[3]."</div>
					  <tr>";
			}
		?>
	</table>
</div>
<div id="footer">&copy Copyright by Firdaus bin Razali</div>
</body>
</html>
<script type="text/javascript">
	function displayTips(dat) {
		var data = dat;
		//window.alert(data);
		var x = document.getElementById(data);
		if (x.style.display === "none") {
			x.style.display = "block";
		}
		else{
			x.style.display = "none";
		}
	}
</script>