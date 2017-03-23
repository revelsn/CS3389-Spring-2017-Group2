<?php session_start(); //starting the session for user login page
//if user is not signed in or does not have the correct permission (roleID)
//then log them out and toss them to login page with error
include "Database.php";
include "Order.php";
include "DBInventory.php";
include "defaultscripts.php";

if (!isset($_SESSION["user"]) || $_SESSION['role'] != 0) {
    require_once('logout.php');
    header("location:login.php?err=3");
    die();
}
//if user just added an item then add to order
if(isset($_GET['action']) && $_GET['action']=="add") {
    //check to see if customer is creating a new order or adding to order
    if (!isset($_SESSION['currentOrder'])) {
        //Customer is adding the first item to an order, so we need to create an order in the db,
        //create an orderLine in the db for this item, and attach the order to this customer
        include_once "createOrder.php";
    }
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
                            <a href="#">Create Order</a>
                        </li>
                        <li>
                            <a href="#">Order History</a>
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
                        #
                    </th>
                    <th>
                        Product
                    </th>
                    <th>
                        Payment Taken
                    </th>
                    <th>
                        Status
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        TB - Monthly
                    </td>
                    <td>
                        01/04/2012
                    </td>
                    <td>
                        Default
                    </td>
                </tr>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        TB - Monthly
                    </td>
                    <td>
                        01/04/2012
                    </td>
                    <td>
                        Approved
                    </td>
                </tr>
                <tr>
                    <td>
                        2
                    </td>
                    <td>
                        TB - Monthly
                    </td>
                    <td>
                        02/04/2012
                    </td>
                    <td>
                        Declined
                    </td>
                </tr>
                <tr>
                    <td>
                        3
                    </td>
                    <td>
                        TB - Monthly
                    </td>
                    <td>
                        03/04/2012
                    </td>
                    <td>
                        Pending
                    </td>
                </tr>
                <tr>
                    <td>
                        4
                    </td>
                    <td>
                        TB - Monthly
                    </td>
                    <td>
                        04/04/2012
                    </td>
                    <td>
                        Call in to confirm
                    </td>
                </tr>
                </tbody>
            </table> <h3><span class="label label-primary" style="display: block">Total: $1.99</span></h3>
            <button type="button" class="btn btn-primary btn-lg btn-block">
                Submit Order
            </button>
        </div>
    </div>
</div>
</body>
</html>
