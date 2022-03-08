<?php
 include "script/temp.php";
 include 'script/db/dbconfig.php';
?>
<html>
<head>
	<title>Showcase</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
		
	</script>
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
	<?php
	$ID=$_SESSION['ID'];
	$operation="";
	$count="";
	$stat="";
	$query2="";
	$query00="";
	$query=mysqli_query($conn,"select * from pattern");
	while ($arr=mysqli_fetch_row($query)) {
		echo "<div id='item'>
				<form method='POST'>	
					<img src='".$arr[3]."' height=100px width=100px>
					<center>
						<input type='hidden' name='item' value='".$arr[0]."'>".$arr[1]."<br>
						RM".$arr[2]."<br>
					</center>
					<input type='number' name='quantity' min='1' max='5' value='1'><br>
					<input type='hidden' name='price' value='".$arr[2]."'>
					<select name='size'>
						<option value='XS'>XS</option>
						<option value='S'>S</option>
						<option value='M'>M</option>
						<option value='L'>L</option>
						<option value='XL'>XL</option>
						<option value='XXL'>XXL</option>
						<option value='XXXL'>XXXL</option>
						<option value='XXXXL'>XXXXL</option>
						<option value='XXXXXL'>XXXXXL</option>
					</select><br>
					<input type='submit' name='submit' value='Pilih'>
				</form>
				</div>";
	}
	if (isset($_POST["submit"])){
			$item=$_POST["item"];
			$count=$_POST["quantity"];
			$size=$_POST["size"];
			$stat="Dalam pemilihan";
			$price=$_POST["price"];
			$pay=$price*$count;
			$date=date("d-m-Y");
			$time=date("H:ia");
			$query0=mysqli_query($conn,"select OrderStatus,OrderQuantity,OrderPayment,count(*),OrderSize from orders where PatternID='$item' and CustomerID='$ID' and OrderSize='$size'");
			echo $size;
			$arr0=mysqli_fetch_array($query0);
			if ($arr0[3]!=0) {
				$stat0=$arr0[0];
				if ($stat0=="Order dibatalkan") {
					$query00=mysqli_query($conn,"update orders set OrderQuantity='$count',OrderPayment='$pay',OrderStatus='$stat' where PatternID='$item' and CustomerID='$ID' and OrderSize='$size'");
				}
				else{
					$count0=$arr0[1];
					$pay0=$arr0[2];
					$count=$count+$count0;
					$pay=$pay+$pay0;
					$query00=mysqli_query($conn,"update orders set OrderQuantity='$count',OrderPayment='$pay' where PatternID='$item' and CustomerID='$ID' and OrderSize='$size'") or die(mysqli_error($query00));
				}
			}
			else{
				$query1=mysqli_query($conn,"select count(*) from orders");
				$arr2=mysqli_fetch_array($query1);
				$row=$arr2[0];
				$datarow=$row+1;
				if ($row<10){
					$orderid="Or00$datarow";
				}
				else
				if ($row<100){
					$orderid="Or0$datarow";
				}
				else{
					$orderid="Or$datarow";
				}
				//echo $orderid." ".$item." ".$ID." ".$count." ".$size." ".$stat." ".$pay." ".$date." ".$time;
				$query2=mysqli_query($conn,"INSERT INTO orders (OrderID, PatternID, CustomerID, OrderQuantity, OrderSize, OrderStatus, OrderPayment, OrderDate, OrderTime)values('$orderid','$item','$ID','$count','$size','$stat','$pay','$date','$time')")or die(mysqli_error($query2));
			}
			if ($query2!="") {
 				$file=basename(__FILE__,'.php');
 				$_SESSION['file']=$file;
 				include 'popup.php';
				echo "<input type='hidden' id='pop'>";
			}
			elseif ($query00!="") {
 				$file=basename(__FILE__,'.php');
 				$_SESSION['file']=$file;
 				include 'popup.php';
				echo "<input type='hidden' id='pop'>";
			}
			else{
 				$file=basename(__FILE__,'.php');
 				$_SESSION['file']=$file;
 				$fileerr=$file."err";
 				$_SESSION['fileerr']=$fileerr;
 				include 'popup.php';
				echo "<input type='hidden' id='pop'>";
			}
		}
	?>
</div>
<div id="footer">&copy Copyright by Firdaus bin Razali</div>
</body>
</html>
<script type="text/javascript">
var modal = document.getElementById('popup');
modal.style.display = "none";

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close");

// When the user clicks the button, open the modal 
window.onload = function(){
  if (document.getElementById("pop")) {
    modal.style.display = "block";
  }
}

btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>