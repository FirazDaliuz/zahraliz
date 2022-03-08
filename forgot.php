<?php
 include 'script/db/dbconfig.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forget</title>
	<link rel="stylesheet" type="text/css" href="forgot.css">
</head>
<body>

	<div id="content">
		<?php
			if (isset($_POST['confirm'])) {
				# code...
			}
			else
			if (isset($_POST['check'])) {
				$email=$_POST['email'];
				$query=mysqli_query($conn,"select * from user,customer where user.UserID=customer.UserID and CustomerEmail='$email'");
				while ($array=mysqli_fetch_array($query)) {
					$username=$array[1];
					echo "<center>
							<div id='input2'>Adakah ini anda?<br>
							$username</div>
							<form method='POST' id='form2'>
								<input type='submit' name='confirm' value='Ya'>
								<input type='submit' name='tak' value='Tak'>
							</form>
						  </center>";
				}
			}
			else
			{
				echo "<center>
						<div id='input'>Masukkan E-mel anda di bawah</div>
					  	<form method='POST' id='form1'>
					  		<input type='email' name='email' required>&nbsp
					  		<input type='submit' name='check' value='Periksa'>
					  	</form>
					  </center>";
			}
		?>
		<div id="button">
			<center>
				<a href="forgot.php"><button>Refresh Halaman</button></a>
				<a href="index.php"><button>Halaman Login</button></a>
			</center>
		</div>
	</div>
</body>
</html>