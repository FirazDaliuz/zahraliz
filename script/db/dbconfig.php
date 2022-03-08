<?php
//config untuk penyambungan ke mysql
$servername="localhost";//nama server
$user="root";//nama user
//$user="epiz_22412130";
$pass="";//password
//$pass="LGxAlUfzn";
$db="zl";//nama database
//$db="epiz_22412130_zl";
$conn=mysqli_connect($servername,$user,$pass,$db);//declare variable conn sama dengan syntax mysqli_connect
if (!$conn) {//jika conn tidak jadi
	echo "Penyambungan Gagal : ".mysqli_error();//
}
?>