<?php include 'header.php';?>
<?php include 'returnInventory.php';?>
<div class="container-fluid"  style="padding-top: 30px">

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
                            <a href="employeeViewInventory.php">Inventory Manager</a>
                        </li>
                        <li>
                            <a href="employeeViewOrders.php">View Orders</a>
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
	    <div class="col-md-8">
	    <a class="btn btn-default" href="lowOnStock.php" role="button">See Low Stock Items</a>
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
	                <?php echo returnInventory();?>
	                </tbody>
	            </table>
	        </div>
	    </div>
	    <div class="col-md-4 well">
	    <form action="DBaddItem.php" method="post">
		  <div class="form-group">
		    <label for="itemName">Name</label>
		    <input type="text" class="form-control" id="itemName" name="itemName" placeholder="">
		  </div>
		  <div class="form-group">
		    <label for="description">Description</label>
		    <input type="text" class="form-control" id="description" name="description" placeholder="">
		  </div>
		  <div class="form-group">
				
				<select name="Categories" class="form-control">
			    	<?php echo returnCategoriesSelect();?>
			  	</select>
		  	</div>
		  <div class="form-group">
		    <label for="price">Price</label>
		    <div class="input-group">
		    <span class="input-group-addon">$</span>
		    <input type="text" class="form-control" id="price" name="price" placeholder="0.00">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="quantity">Quantity</label>
		    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="0">
		  </div>
		  <button type="submit" class="btn btn-default">Add Item</button>
		</form>
		<?php
          $errors = array (
              1 => "Try Again! Failed to add item.",
          );

          $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;
          if (isset($error_id) && array_key_exists($error_id, $errors)) {
              if($error_id == 5) {
              	echo '<div class="alert alert-success" role="success">'.$errors[$error_id].'</div>';
              } else {
              	echo '<div class="alert alert-danger" role="alert">'.$errors[$error_id].'</div>';
              }
          		
          }
			
          ?>
	    </div>
     </div>
</div>
    <?php var_dump(get_defined_vars())?>
</div>
<?php include 'footer.php';?>
