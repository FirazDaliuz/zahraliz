<?php
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
 $usertemp=$_SESSION['templogin'];
 if ($usertemp>=1)
 	$temp=$usertemp;
 else
  include "index.php";
?>