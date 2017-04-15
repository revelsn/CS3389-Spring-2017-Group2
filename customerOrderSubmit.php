<?php include 'header.php';?>
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<div class="container-fluid" style="padding-top: 30px">
	<div class="row">
	        <div class="col-md-12">
	            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	                <div class="navbar-header">
	
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	                </button> 
	                <a class="navbar-brand" href="#">
	        		<img alt="Brand" src="wigglypiggly.png" style="width: 25px;height: 25px">
	      			</a>
	                </div>
	
					<div class="collapse navbar-collapse"
						id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active"><a href="customerDash.php">Create Order</a></li>
							<li><a href="customerOrderHistory.php">Order History</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
	                        <li class="dropdown">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']?><strong class="caret"></strong></a>
	                            <ul class="dropdown-menu">
	                                <li>
	                                    <a href="#">Profile</a>
	                                </li>
	                                <li>
	                                    <a href="logout.php">Sign out</a>
	                                </li>
	                            </ul>
	                        </li>
	                    </ul>
					</div>
					
					
	                    </nav>
	           </div>
	</div>
	<div class="col-md-12">
		            <h3 class="text-center">
		                Submit Order
		            </h3>
		            <table class="table">
		                <thead>
		                <tr>
		                    <th>
		                        Product
		                    </th>
		                    <th>
		                        Subtotal
		                    </th>
		                    <th>
		                        Quantity
		                    </th>
		                </tr>
		                </thead>
		                <tbody>
		                <?php
		                echo $order->returnCurrentOrderItems('customerOrderSubmit');
		                ?>
		                </tbody>
		            </table> 
		            <h3>
		            <span class="label label-primary" style="display: block"><?php echo "Total: $".$order->getRunningTotal();?></span>
		            </h3>
		            TODO: This is where the calendar selector should be located...
		            
		            <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
					<script type="text/javascript">
					$(function() {
					    $('input[name="daterange"]').daterangepicker();
					});
					</script>
		            
		          	<form action="customerDash.php?">
		            <button type="button" class="btn btn-primary btn-lg btn-block">
		                Submit Order
		            </button>
		            </form>
		            
	</div>
</div>