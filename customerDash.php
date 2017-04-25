<?php include 'header.php';?>
<style media="screen" type="text/css">
.label {
  -webkit-border-radius: 0;
     -moz-border-radius: 0;
          border-radius: 0;
}
.item {
	border: 5px solid #aaaaaa;
}
</style>
<div class="container-fluid" style="padding-top: 30px">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button> 
                <a class="navbar-brand" href="customerDash.php">
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
	<div class="row">
            
        
        <div class="col-lg-6">
				<form role="search" method="post" action="customerDash.php?action=search">
					<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="search">
					
					<span class="input-group-btn">
					<button type="submit" class="btn btn-default">Submit</button>
					</span>
					</div>
				</form>
		</div>
		<div class="col-lg-2">
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button"
					id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="true">
					Category <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			    	<?php echo returnCategories();?>
			  	</ul>
		  	</div>
	  	</div>
  	</div>
  	<div class="row">
	            <div class="col-md-8">
	                <?php
	                if (isset($_GET['action']) && $_GET['action'] == 'search') {
	                	echo itemSearch();
	                } else if (isset($_GET['category'])){
	                	echo returnItemsByCategory();
	                } else {
	                	echo returnInStockInv();
	                }
	                
	                ?>
                </div>

	        <div class="col-md-4 sidebar">
	            <h3 class="text-center">
	                Your Cart <?php
	                if ($order->numOfItems() == 1) {
	                	echo '- '.$order->numOfItems().' Item';
	                } elseif ($order->numOfItems() > 1) {
	                	echo '- '.$order->numOfItems().' Items';
	                }
	                ?> 
	            </h3>
	            <table class="table table-striped table-hover">
	                <thead style="background: darkgrey">
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
	                    <th></th>
	                </tr>
	                </thead>
	                <tbody>
	                <?php
	                echo $order->returnCurrentOrderItems('customerDash');
	                ?>
	                </tbody>
	            </table> <h3><span class="label label-primary" style="display: block"><?php if ($order->getRunningTotal() != ''){ echo "Total: $".$order->getRunningTotal();} else {echo "Total: $0.00";}?></span></h3>
	            <form action="customerOrderSubmit.php">
	            <button type="submit" class="btn btn-primary btn-lg btn-block">
	                Submit Order
	            </button> 
	            </form>
	        </div>
    </div>
</div>
<?php include 'footer.php';?>
