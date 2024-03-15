<?php
	require_once 'core.php';
	$output='';
	if (isset($_POST["export"])) {
		/*$sql = "SELECT order_id, order_date, client_name, client_contact, payment_status FROM orders WHERE order_status = 1";*/
		$sql= "SELECT orders.order_id, orders.order_date,orders.client_name,orders.client_contact,orders.payment_status,order_item.quantity FROM order_item RIGHT JOIN orders  ON order_item.order_item_id =orders.order_id WHERE orders.order_status = 1";
		$result = $connect->query($sql);
		if($result->num_rows > 0){
			$output.='
				<table class="table" bordered="1">
				<tr>
					<td>Id</td>
					<td>client_name</td>
					<td>client_contact</td>
					 
					 
				</tr>
			';
			while ($row =mysqli_fetch_array($result)) {
				$output .='
					<tr>
						<td>'.$row["order_id"].'</td>
						<td>'.$row["client_name"].'</td>
						<td>'.$row["client_contact"].'</td>
						 
					</tr>
				';
			}
			$output .='</table>';
			header("Content-Type: application/xls");
			header("Content-Disposition: attachment; filename=download.xls");
			echo $output;
		}
		
	}
?>