<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/19/2017
 * Time: 4:43 PM
 */

session_start();   //starting the session for user profile page
$DB_HOST = '35.184.123.250';
$DB_NAME = 'wigglydb';
$DB_USER = 'web';
$DB_PASSWORD = 'kMC`NX,<NcCk!>7E';
//grab from POST first name, last name, email (all sanitized), and immediately hashing password.
$first = filter_var($_POST['inputFirstName'], FILTER_SANITIZE_STRING);
$last = filter_var($_POST['inputLastName'], FILTER_SANITIZE_STRING);
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
//check for email existence, unnecessary since the user can't get out of register.php without email, but whatever :P
if(isset($email)){
    //if email is set, then prepare and execute SQL statement looking for user email
    $getUsers = $pdo->prepare("SELECT email FROM Users WHERE email=?");
    $getUsers->execute([$email]);
    //next we get how many rows exist with that same email, since it is sanitized no worry about upper v. lowercase
    $get_rows = $getUsers->rowCount();
    //check if the email already exists in the db
    if($get_rows >=1){
        //if it does, then the user has an account
        echo "<h1>user exists</h1>";
        //return the user to the register page with an error code of 1
        header("location:register.php?err=1");

    }

else{
    //else the user does not exist in the db
    echo "<h1>user does not exist</h1>";
    //prepare and execute SQL INSERT for this new user
    $stmt = $pdo->prepare('INSERT INTO `Users` (`firstName`, `lastName`, `email`, `passwordHash`) VALUES (?, ?, ?, ?)');
    $stmt->execute([$first, $last, $email, $pass]);
    //currently this sets the roleID to the default value of 0, might need to be changed in the future...
}



}



