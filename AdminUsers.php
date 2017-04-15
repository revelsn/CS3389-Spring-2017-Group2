<?php include 'header.php';?>
<?php include 'ReturnUsers.php'; ?>


    
  
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
                        
                        <li class="active">
                            <a href="">View Inventory</a>
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
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>User Role</th>
                </tr>
                </thead>
                <tbody>
                <?php echo returnUsers();?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <?php var_dump(get_defined_vars())?>
</div>
<?php include 'footer.php';?>
