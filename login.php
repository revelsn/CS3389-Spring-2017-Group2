<?php include "header.php";?>

    <div class="container">
        <form action="register.php">
            <button class="btn btn-sm btn-success" type="submit" style="float: right">Sign up</button>
        </form>
      <form class="form-signin" action="DBaccess.php" method="post">
        <h2 class="form-signin-heading, text-center">Wiggly Piggly Sign-in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="inputEmail" value="edwiden96@gmail.com" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="inputPassword" value="NatsuMarsh2016" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          <?php
          // this php code creates an array which currently holds one error, but could hold more, and
          // adds an alert div. If an alert is passed to this page via the GET variable then the div appears
          // and appears to the user. The error will appear if the email and/or password hash in the db
          // does not match the info given by the user
          $errors = array (
              2 => "Failed Authentication! Try again.",
              3 => "You need to login to access that page."
          );

          $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;
          if (isset($error_id) && array_key_exists($error_id, $errors)) {
              echo '<div class="alert alert-danger" role="alert">'.$errors[$error_id].'</div>';
          }

          ?>

      </form>

    </div> <!-- /container -->
<?php include 'footer.php';?>
