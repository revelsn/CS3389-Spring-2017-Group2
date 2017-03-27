<?php session_start();
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/26/2017
 * Time: 7:07 PM
 */
include "defaultscripts.php";
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
    <!--This navigation bar code, the div below this comment, should probably be moved into a file that gets called
    because it is simply duplicate code that will appear in all of the customer pages with minor variations,
    such as which list items are active-->
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
                        <li >
                            <a href="customerDash.php">Create Order</a>
                        </li>
                        <li class="active">
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
<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Order #</th>
                    <th>Submit Time</th>
                    <th>Status</th>
                    <th>Pickup Time</th>
                    <th>Items</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>10:41AM March 2nd, 2017</td>
                    <td><span class="label label-info">Picked Up</span></td>
                    <td>3:00PM March 2nd, 2017</td>
                    <td>10 Grapes, 2 Oranges</td>
                    <td>$20.00</td>
                    <td><a href="orderSubmit.php">Reorder</a></td>
                    <!--Not sure how to move forward dynamically posting the order history, whether it goes in the order class
                     or to create a one time file call, or to create a history object since we will be gathering history data
                     from the db in other places...-->
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
