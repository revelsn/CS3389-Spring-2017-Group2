<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="Registration page">
<meta name="author" content="Wiggly Piggly Family Store">

<title>Registration page for Wiggly Piggly</title>
<?php
//this line automatically adds the bootstrap, validator, jQuery, and some styling scripts
include 'defaultscripts.php';
?>

  </head>

  <body>

    <div class="container">
        <!-- This form has first name, last name, email, password, and password confirm fields for the user to input info -->
      <form class="form-signin" action="DBUserRegister.php" method="post" data-toggle="validator">
        <h2 class="form-signin-heading, text-center">Wiggly Piggly <br>User Registration</h2>
          <!--These labels are screen reader only, not sure if they are required...-->
      <label for="inputFirstName" class="sr-only">First Name</label>
      <span class="label label-info">First Name</span>
      <input type="text" id="inputFirstName" class="form-control" placeholder="First Name" name="inputFirstName" value="" required>

          <label for="inputLastName" class="sr-only">Last Name</label>
          <span class="label label-info">Last Name</span>
          <input type="text" id="inputLastName" class="form-control" placeholder="Last Name" name="inputLastName" value="" required>

        <label for="inputEmail" class="sr-only">Email address</label>
          <span class="label label-info">Email</span>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="inputEmail" value="" required autofocus>
            <!--May or may not need these form groups, left them since the code I found had them...-->
          <div class="form-group">
              <span class="label label-info">Password</span>
              <!--When it comes to the password fields I decided a minimum length of 6 was good, can be changed. The form will not
              allow a submission if the passwords do not match-->
              <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
              <div class="help-block">Minimum of 6 characters</div>
          </div>
          <div class="form-group">
              <span class="label label-info">Confirm Password</span>
              <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these passwords don't match" placeholder="Confirm" required>
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

  </body>
</html>
