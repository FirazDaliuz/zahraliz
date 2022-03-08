<?php
include 'script/db/dbconfig.php';
?>
<?php
$data=mysqli_query($conn,"select Type from user where Password='1'");
$data1=mysqli_fetch_row($data);
$data2=$data1[0];
echo "$data2";
?>