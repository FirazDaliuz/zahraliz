<?php
 include "../script/temp.php";
 include '../script/db/dbconfig.php';
?>
<html>
<head>
	<title>Order</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="banner">
	<img src="../media/logo.png" id="bannerii">
	<img id="banneri" src="../media/NBANNER.png">
	<img src="../media/logo.png" id="bannerii">
</div>
<div id="nav">
<ul>
	<li><a href="home.php">Home</a></li>
	<li><a href="design.php">Design</a></li>
	<li><a href="order.php">Order</a></li>
	<li><a href="log.php">Log</a></li>
	<li><a href="index.php">Keluar</a></li>
</ul>
</div>
<div id="content">
	<table id="order">
		<tr>
			<th>Order ID</th>
			<th>Customer Name</th>
			<th>Address</th>
			<th>Customer Number Phone</th>
			<th>Customer Email</th>
			<th>Pattern Name</th>
			<th>Order Quantity</th>
			<th>Order Size</th>
			<th>Order Status</th>
			<th>Order Payment</th>
			<th>Order Date</th>
			<th>Order Time</th>
			<th>Tracking ID</th>
		</tr>
		<?php
			$query=mysqli_query($conn,"select OrderID,CustomerName,CustomerAddress,CustomerNumPhone,CustomerEmail,PatternName,OrderQuantity,OrderSize,OrderStatus,OrderPayment,OrderDate,OrderTime,TrackingID from orders,customer,pattern where orders.CustomerID=customer.CustomerID && orders.PatternID=pattern.PatternID");
			while ($arr=mysqli_fetch_array($query)) {
				echo "<tr id='or'><td>".$arr[0]."<td>".$arr[1]."<td>".$arr[2]."<td>".$arr[3]."<td>".$arr[4]."<td>".$arr[5]."<td>".$arr[6]."<td>".$arr[7]."<td>".$arr[8]."<td>".$arr[9]."<td>".$arr[10]."<td>".$arr[11]."<td>".$arr[12]."</tr>";
			}
		?>
	</table>
	<div id="operation">
		<form method="POST">
			<select name="operation">
				<option>Operasi Pilihan</option>
				<option value="status">Kemaskini Status</option>
				<option value="tracking">Kemaskini TrackingID</option>
			</select>
			<input type="submit" name="submit" value="Pilih">
			<a href="pdf.php" target="blank"><label id="pdfbutton">PDF</label></a>
			<div id=operation2>
			<?php
				if (isset($_POST['submit'])) {
					$operation=$_POST['operation'];
					switch ($operation) {
						case 'status':
							echo <<<ENDHTML
								<input type='hidden' name='type' value='status'>
								<input type=text placeholder='OrderID' name='orderid'>
								<select name='status'>
									<option value='o1'>Order telah dihantar</option>
									<option value='o2'>Order gantian telah dihantar</option>
								</select>
							ENDHTML;
							break;
						case 'tracking':
							echo <<<ENDHTML
								<input type='hidden' name='type' value='tracking'>
								<input type=text placeholder='OrderID' name='orderid'>
								<input type=text placeholder='Tracking ID' name='trackid'>
							ENDHTML;
							break;
						default:
							# code...
							break;
					}
					echo '&nbsp<input type="submit" name="submit2" value="Kemaskini">';
				}
				elseif (isset($_POST['submit2'])) {
					$type=$_POST['type'];
					$orderid=$_POST['orderid'];
					switch ($type) {
						case 'status':
							$status=$_POST['status'];
							echo $status;
							$query2=mysqli_query($conn,"update orders set OrderStatus='$status' where OrderID='$orderid'");
							break;
						case 'tracking':
							$trackid=$_POST['trackid'];
							echo $trackid." ".$orderid;
							$query2=mysqli_query($conn,"update orders set TrackingID='$trackid' where OrderID='$orderid'");
							break;
						default:
							# code...
							break;
					}
					if ($query2) {
						header("Location:order.php");
					}
					else{
						echo mysqli_error($query2);
					}
				}
			?>
			</div>
		</form>
	</div>
</div>
<div id="footer">&copy Copyright by Firdaus bin Razali</div>
</body>
</html>