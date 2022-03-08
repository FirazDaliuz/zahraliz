<?php
 include "script/temp.php";
 include 'script/db/dbconfig.php';
 //error_reporting(0);
?>
<html>
<head>
	<title>About</title>
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
	<div id="c1">
		<?php
			$ID=$_SESSION['ID'];
			//$arr=['','','a','','',''];
			//echo "$ID";
			//echo $arr[2];
			$query=mysqli_query($conn,"select CustomerName,CustomerAddress,CustomerNumPhone,CustomerEmail,UserName,Password from customer,user where customer.UserID=user.UserID and CustomerID='$ID'")or die(mysqli_error($query));
			if (isset($query)) {
				$arr=mysqli_fetch_array($query);
			}
			else{
				$arr=['','','','','',''];
			}
			if (isset($_POST['submit'])) {
				$userid=$_POST['UserID'];
				$name=$_POST['Name'];
				$address=$_POST['Address'];
				$phonenum=$_POST['PhoneNum'];
				$email=$_POST['Email'];
				$password=$_POST['Password'];
				$query2=mysqli_query($conn,"select UserID from customer where CustomerID='$ID'");
				if ($query2) {
					$arr2=mysqli_fetch_array($query2);
					$IDUSER=$arr2[0];
					$query3=mysqli_query($conn,"update user set UserName='$userid',Password='password' where UserID='$ID'");
					$query4=mysqli_query($conn,"update customer set CustomerName='$name',CustomerAddress='$address',CustomerNumPhone='$phonenum',CustomerEmail='$email' where CustomerID='$ID'");
					if ($query3 && $query4) {
						$file=basename(__FILE__,'.php');
 						$_SESSION['file']=$file;
 						include 'popup.php';
 						$arr=['','','','','',''];
						echo "<input type='hidden' id='pop'>";
					}
					else{
						$file=basename(__FILE__,'.php');
 						$_SESSION['file']=$file;
 						$fileerr=$file."err";
 						$_SESSION['fileerr']=$fileerr;
 						$arr=['','','','','',''];
 						include 'popup.php';
						echo "<input type='hidden' id='pop'>";
					}
				}
				else{
					echo "Error: ".die(mysqli_error($query2));
				}
			}
		?>
		<form method="POST">
			<table id="aboutcust">
				<tr>
					<td id="aboutcusttd">Nama Pengguna</td>
					<td><input type="text" name="UserID" value="<?php if (isset($arr[4])){ echo $arr[4];}else{echo "";} ?>" id="un"></td>
				</tr>
				<tr>
					<td id="aboutcusttd">Nama Penuh Pengguna</td>
					<td><input type="text" name="Name" value="<?php if (isset($arr[0])){ echo $arr[0];}else{echo "";} ?>" id="rn"></td>
				</tr>
				<tr>
					<td id="aboutcusttd">Alamat</td>
					<td><textarea name="Address" id="add"><?php if (isset($arr[1])){ echo $arr[1];}else{echo "";} ?></textarea></td>
				</tr>
				<tr>
					<td id="aboutcusttd">No Telefon</td>
					<td><input type="text" name="PhoneNum" value="<?php if (isset($arr[2])){ echo $arr[2];}else{echo "";} ?>" id="ph"></td>
				</tr>
				<tr>
					<td id="aboutcusttd">E-mel</td>
					<td><input type="email" name="Email" value="<?php if (isset($arr[3])){ echo $arr[3];}else{echo "";} ?>" id="em"></td>
				</tr>
				<tr>
					<td id="aboutcusttd">Kata Laluan</td>
					<td><input type="password" name="Password" value="<?php if (isset($arr[5])){ echo $arr[5];}else{echo "";} ?>" id="p"></td>
					<td id="aboutcusttd2"><input type="checkbox" onclick="showPass()">Tunjuk</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Kemaskini"><input type="reset" name="reset" value="Reset"></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="c2">
		<h3>About Us</h3>
		<h3>Bisnes mengenai penjualan pola pakaian yang mengikut trend semasa</h3>
		<h3>Menawar kepelbagaian pola pakaianyang diminati oleh masyarakat</h3>
		<h3>Menyediakan bantuan semasa mengenai proses penghasilan pola pakaian tertentu</h3>
	</div>
</div>
<div id="footer">&copy Copyright by Firdaus bin Razali</div>
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