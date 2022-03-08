<?php
 include "script/temp.php";
 include 'script/db/dbconfig.php';
 $paypalUrl='https://www.sandbox.paypal.com/cgi-bin/webscr';
 $paypalId='muhdfirdaus1011-facilitator@gmail.com';
?>
<html>
<head>
	<title>Cart</title>
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
	<form method='POST'>
	<table id="cart">
		<tr>
			<th>
				Nama Pola Pakaian
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="<?php echo $paypalId; ?>">
				<input type="hidden" name="cancel_return" value="http:\\localhost\zl\script\api\paypal\error.php">
				<input type="hidden" name="return" value="http:\\localhost\zl\script\api\paypal\success.php">
				<input type="hidden" name="currency_code" value="MYR">
			<th>Kuantiti
			<th>Saiz
			<th>Status
			<th>Harga
			<th>Kemaskini
		</tr>
		<?php
			$ID=$_SESSION['ID'];
			$total=0;
			$loop='';
			$l=0;
			$dl=1;
			$query=mysqli_query($conn,"select PatternName,OrderID,OrderQuantity,OrderSize,OrderStatus,OrderPayment,PatternPrice from orders,pattern where customerid='$ID' && orders.PatternID=pattern.PatternID");
			while ($arr=mysqli_fetch_array($query)) {
				if ($arr[4]!="Order dibatalkan") {
					echo "<tr id='or'>
						<td><input type='hidden' name='data[]' value=".$arr[1].">".$arr[0]."<input type='hidden' name='item_name_".$dl."' value='".$arr[0]."'>
						<td>".$arr[2]." pasang<input type='hidden' name='quantity_".$dl."' value='".$arr[2]."'>
						<td>".$arr[3]."
						<td>".$arr[4]."
						<td>RM".$arr[5]."<input type='hidden' name='amount_".$dl."' value='".$arr[6]."'>
						<td>
							<button type='submit' name='add' value='$l'>tambah</button>
							<button type='submit' name='subtract' value='$l'>tolak</button>
							<button type='submit' name='delete'value='$l'>buang</button>
					  </tr>";
					$total=$total+$arr[5];
					$loop=$arr[4];
					$l++;
					$dl++;
				}
			}
			if (isset($_POST['delete'])) {
				$data=$_POST['data'];
				$nl=$_POST['delete'];
				$query2=mysqli_query($conn,"delete from orders where OrderID='$data[$nl]'");
				header("Location:cart.php");
			}
			elseif (isset($_POST['subtract'])) {
				$nl=$_POST['subtract'];
				$data3=$_POST['data'];
				$query5=mysqli_query($conn,"select PatternID,OrderQuantity from orders where OrderID='$data3[$nl]'");
				$arr3=mysqli_fetch_array($query5);
				$patterndat2=$arr3[0];
				$pricequery2=mysqli_query($conn,"select PatternPrice from pattern where PatternID='$patterndat2'");
				$pricearr2=mysqli_fetch_array($pricequery2);
				$pricedat2=$pricearr2[0];
				$dat3=$arr3[1];
				if ($dat3>1) {
					$dat4=$dat3-1;
					$price2=$pricedat2*$dat4;
					$query6=mysqli_query($conn,"update orders set OrderQuantity='$dat4',OrderPayment='$price2' where OrderID='$data3[$nl]'");
				}
				else{
					$query6=mysqli_query($conn,"delete from orders where OrderID='$data3'");
				}
				header("Location:cart.php");
			}
			elseif (isset($_POST['add'])){
				$nl=$_POST['add'];
				$data2=$_POST['data'];
				$query3=mysqli_query($conn,"select PatternID,OrderQuantity from orders where OrderID='$data2[$nl]'");
				$arr2=mysqli_fetch_array($query3);
				$patterndat=$arr2[0];
				$pricequery=mysqli_query($conn,"select PatternPrice from pattern where PatternID='$patterndat'");
				$pricearr=mysqli_fetch_array($pricequery);
				$pricedat=$pricearr[0];
				$dat=$arr2[1];
				$dat2=$dat+1;
				$price=$pricedat*$dat2;
				$query4=mysqli_query($conn,"update orders set OrderQuantity='$dat2',OrderPayment='$price' where OrderID='$data2[$nl]'");
				header("Location:cart.php");
			}
			echo "<tr id='or1'><th colspan='4'>Jumlah</td><td>RM$total</td>";
		?>
			<td id="op">
				<?php 
					if ($loop=="Order yang sedang disiapkan") {
						echo "<input type='submit' name='cancel' value='Batal'>
							  <a href='pdf.php' target='blank'><label id='pdfbutton'>PDF</label></a>
							  <input type='submit' name='track' value='Tracking ID'>
						";
					}
					else{
						echo "<input type='submit' name='checkout' value='Checkout' formaction='$paypalUrl' formtarget='paypal'>
							  <input type='submit' name='resetcart' value='Reset'>";
					} 
				?>
		</tr>
	</form>
	</table>
	<?php
	$ID=$_SESSION['ID'];
	if (isset($_POST['checkout'])) {
		$arr=mysqli_fetch_array($query);
		$data=$arr[0];
		$query1=mysqli_query($conn,"update orders set OrderStatus='Order yang sedang disiapkan' where CustomerID='$ID'");
		//echo "Terima kasih, notifikasi tempahan anda akan dihantar kepada anda melalui aplikasi whatapps atau messenger.";
		//header("Location:home.php");
		if ($query1) {
			$file=basename(__FILE__,'.php');
 			$_SESSION['file']=$file;
 			$_SESSION['file2']=1;
 			include 'popup.php';
			echo "<input type='hidden' id='pop'>";
		}
		else{
 			$file=basename(__FILE__,'.php');
 			$_SESSION['file']=$file;
 			$_SESSION['file2']=1;
 			$fileerr=$file."err";
 			$_SESSION['fileerr']=$fileerr;
 			include 'popup.php';
			echo "<input type='hidden' id='pop'>";
		}
	}
	elseif (isset($_POST['cancel'])) {
		$query7=mysqli_query($conn,"update orders set OrderStatus='Order dibatalkan' where CustomerID='$ID'");
		if ($query7) {
			$file=basename(__FILE__,'.php');
 			$_SESSION['file']=$file;
 			$_SESSION['file2']=2;
 			include 'popup.php';
			echo "<input type='hidden' id='pop'>";
		}
		else{
 			$file=basename(__FILE__,'.php');
 			$_SESSION['file']=$file;
 			$fileerr=$file."err2";
 			$_SESSION['fileerr']=$fileerr;
 			include 'popup.php';
			echo "<input type='hidden' id='pop'>";
		}
	}
	elseif (isset($_POST['resetcart'])) {
		$query8=mysqli_query($conn,"delete from orders where CustomerID='$ID'");
		header("Location:cart.php");
	}
	elseif (isset($_POST['track'])) {
		$file=basename(__FILE__,'.php');
 		$_SESSION['file']=$file;
 		$_SESSION['file2']=3;
 		include 'popup.php';
		echo "<input type='hidden' id='pop'>";
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