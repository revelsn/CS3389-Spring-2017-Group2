<?php include 'header.php';?>
    <div class="container">
    <div class="row">
        <form action="login.php">
            <button class="btn btn-sm btn-success" type="submit" style="float: right">Sign in</button>
        </form>
        </div>
        <div class="row">
       <img alt="Brand" src="wigglypiggly.png" style="width: 200px;height: 200px" class="center-block">
       </div>
        <!-- This form has first name, last name, email, password, and password confirm fields for the user to input info -->
      <form class="form-signin" action="DBUserRegister.php" method="post" data-toggle="validator">
        <h2 class="form-signin-heading, text-center">Wiggly Piggly <br>User Registration</h2>
          <!--These labels are screen reader only, not sure if they are required...-->
      <label for="inputFirstName" class="sr-only">First Name</label>
      <input type="text" id="inputFirstName" class="form-control" placeholder="First Name" name="inputFirstName" value="" required>

          <label for="inputLastName" class="sr-only">Last Name</label>
          <input type="text" id="inputLastName" class="form-control" placeholder="Last Name" name="inputLastName" value="" required>

          <label for="inputTelephone" class="sr-only">Telephone Number</label>
          <input type="text" id="inputTelephone" class="form-control" placeholder="123-456-8910" name="inputTelephone" value="" required>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="inputEmail" value="" required autofocus>
            <!--May or may not need these form groups, left them since the code I found had them...-->
          <div class="form-group">
              <!--When it comes to the password fields I decided a minimum length of 6 was good, can be changed. The form will not
              allow a submission if the passwords do not match-->
              <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
              <div class="help-block">Minimum of 6 characters</div>
          </div>
          <div class="form-group">
              <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these passwords don't match" placeholder="Confirm Password" required>
              <div class="help-block with-errors"></div>
          </div>
          <!--This button is locked until all fields are filled, email is of proper form, and the two password fields agree-->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
          <?php
          //this php code creates an array which currently holds one error, but could hold more, and
          // adds an alert div. If an alert is passed to this page via the GET variable then the div appears
          // and appears to the user. This is currently used for if an email is already taken, then the user
          //sees an error and must retry or go to the login page and login
          $errors = array (
              1 => "User already exists! <a href='login.php' class='alert-link'>Try logging in!</a>"
          );

          $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;
          if ($error_id == 1) {
              echo '<div class="alert alert-danger" role="alert">'.$errors[$error_id].'</div>';
          }
          ?>
      </form>

    </div> <!-- /container -->

<?php include 'footer.php';?>
