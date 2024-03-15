<?php require_once 'includes/header.php'; ?>

<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1&&2";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = 0;
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['paid'];
}
//for low stock level..
$lowStockSql = "SELECT * FROM product WHERE quantity <= 7 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

//for due payments..
/*$dueSql = "SELECT * FROM orders  WHERE payment_status = 3 AND status = 1";
$dueamt = $connect->query($dueSql);
$countdueamt = $dueamt->num_rows;*/

//for total users..
$tusers = "SELECT * FROM users";
$tnusers = $connect->query($tusers);
$countUsers = $tnusers->num_rows;
//echo "$countUsers";

//for Farm Item Stock Low..
$lowItemSql = "SELECT * FROM farmstore WHERE quantity <= 7 AND status = 1";
$lowItemQuery = $connect->query($lowItemSql);
$countLowItem = $lowItemQuery->num_rows;


$userwisesql = "SELECT users.username , SUM(orders.grand_total) as totalorder FROM orders INNER JOIN users ON orders.user_id = users.user_id WHERE orders.order_status = 1 GROUP BY orders.user_id";
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;

$connect->close();

?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
	
</style>
<div class="row">
	<a href="product.php" style="text-decoration:none;color:black;">
	<div class="col-md-4">
		<div class="panel panel-primary " style="border-color: black;">
			<div class="panel-heading">
				
				
					<i class="glyphicon glyphicon-th"></i>
					Total Product
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	</a>


	<a href="lowproduct.php" style="text-decoration:none;color:black;">
	<div class="col-md-4">
		<div class="panel panel-danger" style="border-color: black;">
			<div class="panel-heading">
					<i class="glyphicon glyphicon-warning-sign"></i>
					Low Stock..
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	</a>

	<!-- for farm item low notification -->
	<a href="lowfarmstore.php" style="text-decoration:none;color:black;">
	<div class="col-md-4">
		<div class="panel panel-danger" style="border-color: black;">
			<div class="panel-heading">
				
					<i class="glyphicon glyphicon-warning-sign"></i>
					Low Farm Store Items
					<span class="badge pull pull-right"><?php echo $countLowItem; ?></span>	
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
 	</a>


	<div class="col-md-4">
	<!-- Total Orders -->
		<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
		<div class="card" style="box-shadow: 0 0 7px black;">
		  <div class="cardHeader" style="background-color: #087fe8;">
		    <h1>
		    	
		    	<p><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;&nbsp;<?php echo $countOrder; ?></p>
			</h1>
		  </div>

		  <div class="cardContainer">
		    <p>Total Sales</p> 
		  </div>
		</div>
		</a>
	</div>
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
	<div class="col-md-4">
		<div class="card" style="box-shadow: 0 0 7px black;">
		  <div class="cardHeader" style="background-color: #087fe8;">
		    <h1><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<?php echo $countUsers; ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p>Total Users</p>
		  </div>
		</div> 
		<br/>
	</div>
	<?php } ?>
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']!=1) { ?>
		<div class="col-md-4">
		<div class="card" style="box-shadow: 0 0 7px black;">
		  <div class="cardHeader" style="background-color: #087fe8;">
		    <h1><i class="glyphicon glyphicon-calendar"></i>&nbsp;<?php echo date('l'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('m') .', '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>
</div>	

	
	<?php } ?>
	<div class="col-md-4">
		<div class="card" style="box-shadow: 0 0 7px black;">
		  <div class="cardHeader" style="background-color:#087fe8;">
		    <h1> <i class="glyphicon glyphicon-piggy-bank"></i>&nbsp; Rs.<?php if($totalRevenue) {
		    	echo $totalRevenue;
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p>Total Revenue Till Date</p>
		  </div>
		</div> <!-- col-md-4 -->
		<br>	
</div> 


	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
	<div class="col-md-12">
		<div class="panel panel-default" style="border-color: black;">
			<div class="panel-heading"> <i class="glyphicon glyphicon-menu-hamburger"></i>Sales Done By</div>
			<div class="panel-body">
				<table class="table" id="productTable" border="1px">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Name</th>
			  			<th style="width:20%;">Orders in Rupees</th>
			  		</tr>
			  	</thead>
			  	<tbody>
					<?php 
						 
					while ($orderResult = $userwiseQuery->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $orderResult['username']?></td>
							<td>Rs.<?php echo $orderResult['totalorder']?></td>

						</tr>
						
					<?php } ?>
				</tbody>
				</table>
			</div>	
		</div>
		
	</div> 
	<?php  } ?>
	
</div> <!--/row-->
 
 <?php require_once 'includes/footer.php'; ?>	 
			