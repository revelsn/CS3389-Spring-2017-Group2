<?php
//This file creates a PDO and runs a SQL SELECT statement using the email and passwordHash
//generated from the password given by the user. If those two pieces of info match a row
//in the database then the webpage prints a success message, otherwise it prints an error
//This is only intended as a test page for checking hashes and emails and access to the db.
include "Database.php";
function SignIn()
{
    session_start();
	//filter email and hash password
    $email = filter_var($_POST['inputEmail'], FILTER_SANITIZE_EMAIL);
    $pass = sha1($_POST['inputPassword']);
    //create database object
    $db = new Database();
    $db->_construct();
    //setup query and bind params
    $db->query('SELECT PasswordHash, email, roleID FROM Users WHERE email = :email AND passwordHash = :pass');
    $db->bind(':email', $email);
    $db->bind(':pass', $pass);
    //request the single row
    $row = $db->single();
    //if the hashes match along with the email then....
    if ($row['PasswordHash'] == $pass && $row['email'] == $email)
	{
		//send user to customerDash
        $_SESSION["user"] = $email;
        if ($row['roleID'] == 'C') {
            $_SESSION["role"] = 'C';
            header("location:customerDash.php");
        } else if ($row['roleID'] == 'E') {
            $_SESSION["role"] = 'E';
            header("location:employeeDash.php");
        } else if ($row['roleID'] == 'A') {
        	$_SESSION["role"] = 'A';
        	header("location:AdminHome.php");
        }

	} else {
        //return the user to the login page with an error code of 2
        header("location:login.php?err=2");
        $_SESSION["user"] = "";
	}

}
	//yeah, so I call the above method here and run it, don't ask me why....
	SignIn();
?>
