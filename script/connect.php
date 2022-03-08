<?php
include 'db/dbconfig.php';
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="connect">
<div id="text2">
<?php
session_start();
if (isset($_POST['submit'])) {
	$templogin=1;
	$_SESSION['templogin']=$templogin;
	$ID=$_POST['ID'];
	$Pass=$_POST['Pass'];
	$query = mysqli_query($conn,"select * from user where UserName='$ID' and Password='$Pass'");
	$count = mysqli_fetch_row($query);
	while ($arr=mysqli_fetch_row($query)) {
		$_SESSION['UserID']=$arr[0];
	}
	$query1 = mysqli_query($conn,"select Type from user where UserName='$ID' and Password='$Pass'");
	$proque1 = mysqli_fetch_row($query1);
	$q1 = $proque1[0];
	if (!$count){
    	include("index.php");
    }else{
		if ($q1==1){
			echo "Tahniah, $ID .<br> Log masuk anda telah disahkan <br>Sila tekan butang di bawah untuk memasuki halaman utama<br><a href='../dev/home.php'><button id='h'>Teruskan</button></a>";
		}else{
			$querys=mysqli_query($conn,"select UserID from user where UserName='$ID'");
			while ($arr=mysqli_fetch_array($querys)) {
				$userdat=$arr[0];
			}
			$querys1=mysqli_query($conn,"select CustomerID from customer where UserID='$userdat'");
			while ($arr=mysqli_fetch_array($querys1)) {
				$_SESSION['ID']=$arr[0];
			}
			echo "Tahniah, $ID .<br> Log masuk anda telah disahkan <br>Sila tekan butang di bawah untuk memasuki halaman utama<br><a href='../home.php'><button id='h'>Teruskan</button></a>";
		}
	}
}
?>
</div>
</div>
</body>
</html>