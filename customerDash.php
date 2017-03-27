<?php session_start(); //starting the session for user login page
//if user is not signed in or does not have the correct permission (roleID)
//then log them out and toss them to login page with error
include "defaultscripts.php";
include "Database.php";
include "Order.php";
include "DBInventory.php";
//user check should happen before checking for order
if (!isset($_SESSION["user"]) || $_SESSION['role'] != 0) {
    require_once('logout.php');
    header("location:login.php?err=3");
    die();
}
//unserialize order if set else create new order object.
$order = "";
if (!isset($_SESSION['currentOrder'])) {
    $order = new Order();
} else {
    $order = unserialize($_SESSION['currentOrder']);
}

//if user just added an item then add to order
if(isset($_GET['action']) && $_GET['action']=="add") {
    //check to see if customer is creating a new order or adding to order
    if (!isset($_SESSION['currentOrder'])) {
        //Customer is adding the first item to an order, so we need to create an order in the db,
        //create an orderLine in the db for this item, and attach the order to this customer
        $order->setCustomerID($_SESSION['user']);
        $order->createOrder();
    } else {
        $order->addToOrder();

    }
    $_SESSION['currentOrder'] = serialize($order);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wiggly Piggly User Dashboard</title>


    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>
<div class="container-fluid">
    <!--See customerOrderHistory.php for comment on the div code below this tag, TLDR, it may need to be dynamically
    generated to reduce duplicate code-->
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button> <a class="navbar-brand" href="#">Wiggly Piggly</a>
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
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">*Customer Name*<strong class="caret"></strong></a>
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
                echo returnInStockInv();
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
