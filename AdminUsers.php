<?php include 'header.php';?>
<?php include 'ReturnUsers.php'; ?>

<div class="container-fluid"  style="padding-top: 30px">

    <!--This navigation bar code, the div below this comment, should probably be moved into a file that gets called
    because it is simply duplicate code that will appear in all of the customer pages with minor variations,
    such as which list items are active-->
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button><a class="navbar-brand" href="AdminHome.php">
        		<img alt="Brand" src="wigglypiggly.png" style="width: 25px;height: 25px">
      			</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        
                         <li class="active">
                            <a href="AdminUsers.php">Users</a>
                        </li>
                        <li  >
                            <a href="adminViewInventory.php">Inventory</a>
                        </li>
                        <li>
                            <a href="AdminViewOrders.php">Orders</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION ['user'] ?><strong class="caret"></strong></a>
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
            <table class="table table-striped">
                <thead style="background: darkgrey">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>User Role</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php echo returnUsers();?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php include 'footer.php';?>
