<?php include 'header.php';?>
<!-- Include Required Prerequisites -->
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>


<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script type="text/javascript">
	$(function() {
	    $('.datepicker').datepicker({
	    	daysOfWeekDisabled: '06',
		    format: 'mm-dd-yyyy',
			startDate: '0d',
		    endDate: '+6d'
			    });
	});
	$(document).ready(function(){
	    $('.timepicker').timepicker({
	    	timeFormat: 'HH:mm',
	        interval: 15,
	        minTime: '10',
	        maxTime: '6:00pm',
	        defaultTime: '11',
	        startTime: '10:00',
	        dynamic: false,
	        dropdown: true,
	        scrollbar: true
	        });
	});
</script>

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
							<li><a href="customerDash.php">Create Order</a></li>
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
	<div class="col-md-12">
		            <h3 class="text-center">
		                Submit Order
		            </h3>
		            <table class="table table-striped">
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
		                </tr>
		                </thead>
		                <tbody>
		                <?php
		                echo $order->returnCurrentOrderItems('customerOrderSubmit');
		                ?>
		                </tbody>
		            </table> 
		            <h3>
		            <span class="label label-primary" style="display: block"><?php if ($order->getRunningTotal() != ''){ echo "Total: $".$order->getRunningTotal();} else {echo "Total: $0.00";}?></span>
		            </h3>
		            <form class="form-inline col-md-offset-2" action="DBorderSubmit.php" method="post" data-toggle="validator">
			            Select date/time of pickup: <input type="text" class="datepicker form-control" readonly="readonly" name="date" required/>
	
			            <input type="text" class="timepicker form-control" name="time" readonly="readonly" value="10:00 AM" required>
	 					
						
			            <button type="submit" class="btn btn-danger ">
			                Submit Order
			            </button>
		            </form>
		            <?php
          // this php code creates an array which currently holds one error, but could hold more, and
          // adds an alert div. If an alert is passed to this page via the GET variable then the div appears
          // and appears to the user. The error will appear if the email and/or password hash in the db
          // does not match the info given by the user
          $errors = array (
              2 => "Failed Authentication! Try again.",
              3 => "You need to login to access that page.",
			  4 => "Select a date/time for pickup above"
          );

          $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;
          if (isset($error_id) && array_key_exists($error_id, $errors)) {
              echo '<div class="alert alert-danger" role="alert">'.$errors[$error_id].'</div>';
          }
         
          ?>
		            
	</div>
</div>