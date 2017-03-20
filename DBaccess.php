<?php
//This file creates a PDO and runs a SQL SELECT statement using the email and passwordHash
//generated from the password given by the user. If those two pieces of info match a row
//in the database then the webpage prints a success message, otherwise it prints an error
//This is only intended as a test page for checking hashes and emails and access to the db.
function SignIn()
{
	session_start();   //starting the session for user login page
    $DB_HOST = '35.184.123.250';
    $DB_NAME = 'wigglydb';
    $DB_USER = 'web';
    $DB_PASSWORD = 'kMC`NX,<NcCk!>7E';
	//filter email and hash password
    $email = filter_var($_POST['inputEmail'], FILTER_SANITIZE_EMAIL);
    $pass = sha1($_POST['inputPassword']);
	//setup for creating PDO
    $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    //create PDO
    $pdo = new PDO($dsn, $DB_USER, $DB_PASSWORD, $opt);
	//prepare SQL statement and execute with parameters passed by login.php
    $stmt = $pdo->prepare('SELECT PasswordHash, email FROM Users WHERE email = ? AND passwordHash = ?');
    $stmt->execute([$email, $pass]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //if the hashes match along with the email then....
    if ($row['PasswordHash'] == $pass && $row['email'] == $email)
	{
		//echo out success message
		echo '<h1>Successful login, email and hash matches</h1>';
	} else {
    	//else echo out error message, neither look pretty right now...
    	echo '<h1>Unsuccessful login, email or hash does not match</h1>';
	}

}
	//yeah, so I call the above method here and run it, don't ask me why....
	SignIn();
?>
