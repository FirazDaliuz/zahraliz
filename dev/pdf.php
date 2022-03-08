<?php
include "../script/temp.php";
include '../script/db/dbconfig.php';
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$html="
<div>
	<img src='../media/logo.png' width='200px' height='100px'>
	<img src='../media/logo.png' width='200px' height='100px' style='margin-left:620px;'>
</div>
<div style='margin-top:50px;'>
	<table border=1 style='border-collapse:collapse;'>
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
		</tr>";
$query=mysqli_query($conn,"select OrderID,CustomerName,CustomerAddress,CustomerNumPhone,CustomerEmail,PatternName,OrderQuantity,OrderSize,OrderStatus,OrderPayment,OrderDate,OrderTime,TrackingID from orders,customer,pattern where orders.CustomerID=customer.CustomerID && orders.PatternID=pattern.PatternID order by OrderID");
while ($arr=mysqli_fetch_array($query)) {
	$html=$html."<tr id='or'><td>".$arr[0]."<td>".$arr[1]."<td>".$arr[2]."<td>".$arr[3]."<td>".$arr[4]."<td>".$arr[5]."<td>".$arr[6]."<td>".$arr[7]."<td>".$arr[8]."<td>".$arr[9]."<td>".$arr[10]."<td>".$arr[11]."<td>".$arr[12]."</tr>";
			}
$html=$html."</table></div";
//$html = <<<'ENDHTML'
//ENDHTML;
$dompdf->loadHtml($html);
//$dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');


// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('order.pdf',Array('Attachment'=>0));
?>