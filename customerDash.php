<?php include 'header.php';?>
<div class="container-fluid">
    <!--See customerOrderHistory.php for comment on the div code below this tag, TLDR, it may need to be dynamically
    generated to reduce duplicate code-->
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button> <a class="navbar-brand" href="#">
        <img alt="Brand" src="wigglypiggly.png" style="width: 25px;height: 25px">
      </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="customerDash.php">Create Order</a>
                        </li>
                        <li>
                            <a href="customerOrderHistory.php">Order History</a>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search" action="<?php header('Location:customerDash.php?action=search')?>" method="post">
  					<div class="form-group">
    				<input type="text" class="form-control" placeholder="Search" name="search">
  					</div>
  					<button type="submit" class="btn btn-default">Submit</button>
					</form>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $order->getCustomerID();?><strong class="caret"></strong></a>
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
        <div class="col-md-8">
            <div class="row" ><?php var_dump(get_defined_vars())?></div>
            <div class="row">
                <?php
                if (isset($_POST['action']) && $_POST['action'] == 'search') {
                	echo itemSearch();
                } else {
                	echo returnInStockInv();
                }
                
                ?>
            </div>
        </div>
        <div class="col-md-4 sidebar">
            <h3 class="text-center">
                Your Cart - 0 Items
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
                echo $order->returnCurrentOrderItems();
                ?>
                </tbody>
            </table> <h3><span class="label label-primary" style="display: block"><?php echo "Total: $".$order->getRunningTotal();?></span></h3>
            <button type="button" class="btn btn-primary btn-lg btn-block">
                Submit Order
            </button>
        </div>
    </div>
</div>
</body>
</html>
