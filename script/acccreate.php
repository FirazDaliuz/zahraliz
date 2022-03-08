<?php
include 'db/dbconfig.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="acccreate">
<?php 
if (isset($_POST['submit'])) {
	$name=$_POST['UserID'];
	$rname=$_POST['Name'];
	$pass=$_POST['Password'];
	$phonenum=$_POST['PhoneNum'];
	$email=$_POST['Email'];
	$address=$_POST['Address'];
	if ($name=="zahraliz") {
		$userid="admin";
		$type=1;
	}
	else{
		$type=2;
		}
	$count=rand(1000,9999);
	$userid="U".$count;
	$custid="C".$count;
	if ($type!=1) {
		mysqli_query($conn,"insert into user (UserID,UserName, Password, Type) values('$userid','$name', '$pass', '$type')");
		mysqli_query($conn,"insert into customer (CustomerID, UserID, CustomerName, CustomerAddress, CustomerNumPhone, CustomerEmail) values('$custid', '$userid', '$rname', '$address', '$phonenum', '$email')");
		}
		else{
			$userid="admin";
			mysqli_query($conn,"insert into user (UserName, Password, Type) values('$name', '$pass', '$userid')");
		}
	echo "<div id='text'>Syabas, anda berjaya mendaftar masuk.<br>
		  Data anda adalah seperti berikut :<br>
		  <table>
		   <tr>
		    <td>UserName : 
		    <td>$name
		   </tr>
		   <tr>
		   <td>Real Name
		   <td>$rname
		   </tr>
		   <tr>
		    <td>Password : 
		    <td>$pass
		   </tr>
		   <tr>
		    <td>Address : 
		    <td>$address
		   </tr>
		   <tr>
		    <td>Phone Number :
		    <td>$phonenum
		   </tr>
		   <tr>
		    <td>Email : 
		    <td>$email
		   </tr></table><br>
		   </div>";
	header("refresh:3,url=../index.php");
}
else
echo "You are intruding the page";
?>
</div>
</body>
</html>