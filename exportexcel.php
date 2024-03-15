<?php    

require_once 'core.php';

/*$orderId = $_POST['orderId'];*/

$sql = "SELECT order_id, order_date, client_name, client_contact, sub_total, total_amount, discount, grand_total, paid, due FROM orders";
$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();
$orderId = $orderData[0];
$orderDate = $orderData[1];
$clientName = $orderData[2];
$clientContact = $orderData[3]; 
$subTotal = $orderData[4];
$totalAmount = $orderData[5]; 
$discount = $orderData[6];
$grandTotal = $orderData[7];
$paid = $orderData[8];
$due = $orderData[9];
 

$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
   INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);
$html='<table><tr><td>#</td> <td>Sales Date</td> <td>clientName</td> <td>Contact</td> <td>payment status</td>';
echo $html;
   while ($row=mysqli_fetch_assoc($orderResult)) {
      $html.='<tr><td>.$row[0]</td></tr>'
    } 
header('Content-Type:application?xls');
header('Content-Disposition:attachment;filename=report.xls');
 
?>