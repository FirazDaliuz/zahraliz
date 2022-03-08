<?php
$itemNo            = $_REQUEST['item_number'];

$itemTransaction   = $_REQUEST['tx']; // Paypal transaction ID

$itemPrice         = $_REQUEST['amt']; // Paypal received amount

$itemCurrency      = $_REQUEST['cc']; // Paypal received currency type

 

$price = '259.00';

$currency='MYR';

 

if($itemPrice==$price && $itemCurrency==$currency)

{

    echo "Payment Successful";

}

else

{

    echo "Payment Failed";

}
?>