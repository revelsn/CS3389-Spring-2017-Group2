<?php include 'header.php';?>
<?php include 'returnItemsLowOnStock.php';?>
<div class="container-fluid" style="padding-top: 30px">

   <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button><a class="navbar-brand" href="employeeDash.php">
        		<img alt="Brand" src="wigglypiggly.png" style="width: 25px;height: 25px">
      			</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="viewInventory.php">Inventory Manager</a>
                        </li>
                        <li>
                            <a href="viewInventory.php">View Orders</a>
                        </li>
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
<div class="container">
    <div class="row">
    <a class="btn btn-default" href="viewInventory.php" role="button">See All Items In Stock</a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead style="background: darkgrey">
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Items on Hand</th>
                </tr>
                </thead>
                <tbody>
                <?php echo returnItemsLowOnStock();?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <?php var_dump(get_defined_vars())?>
</div>
<?php include 'footer.php';?>
