<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-stats"></i>	Sales Report
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php/getOrderReport.php" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date" autocomplete="off" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">End Date</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="endDate" name="endDate" placeholder="End Date" autocomplete="off"/>
				    </div>
				  </div>
				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
				    </div>
				</div><!-- form-group -->
				  <hr>

				</form>
				 

				</form>

						<!DOCTYPE html>
						 <html>
						 <head>
						 	<title></title>
						 	 
						 </head>
						 <body> 
						 	<table class="table" id="manageOrderTable" border="1">
										<thead>
											<tr>
												<th>#</th>
												<th>Sale Date</th>
												<th>Customer Name</th>
												<th>Contact</th>
												<th>Total Sales Item</th>
												<th>Payment Status</th>
												<th>Option</th>
											</tr>
										</thead>
								</table>
								<!-- <div>
									<form action="export.php" method="post">
										<center><button type="submit" name="export" value="Export to excel" style="background-color: green; color: white; border-radius: 5px;">Excel</button></center>
									</form>
								</div> -->
						 </body>
						 </html>
				</div><!-- /panel-body -->
		</div><!-- /panel panel-default -->
	</div><!--/col-md-12 -->
</div><!-- /row -->

<script src="custom/js/report.js"></script>
<script src="custom/js/order.js"></script>
<?php require_once 'includes/footer.php'; ?>  


	 
			 
		

	 

			 


		