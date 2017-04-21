<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/23/2017
 * Time: 11:47 AM
 *
 *
 * This is the logout protocol for destroying session and client side deleting session cookies.
 * Use this for all logout buttons.
 */
// Initialize the session.
session_start();
include "Database.php";
$db = new Database();
$db->_construct();
//get order being worked on
$db->query('SELECT orderID FROM Orders WHERE customerID = :customerID AND status = "In Progress"');
$db->bind(':customerID', $_SESSION["user"]);
//grab that *hopefully* single order...
$row = $db->single();
//delete orderlines pertaining to order being worked on
$db->query('DELETE FROM OrderLine WHERE orderID = :orderID');
$db->bind(':orderID', $row['orderID']);
$db->execute();
//delete order itself
$db->query('DELETE FROM Orders WHERE orderID = :orderID AND status = "In Progress"');
$db->bind(':orderID', $row['orderID']);
$db->execute();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
//redirect to login page
if(isset($_GET['submit']) && $_GET['submit']== 1) {
	header("location:login.php?err=5");
} else {
	header("location:login.php");
}

?>