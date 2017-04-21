<?php
include 'header.php';
//create database object
$db = new Database();
$db->_construct();
//setup query and bind params
//get order being worked on
if ($_GET['status'] == 'rtp') {
	$status = "Ready to Pickup";
} else if ($_GET['status'] == 'pu') {
	$status = "Picked Up";
}
$db->query('UPDATE Orders SET status=:status WHERE orderID=:orderID');
$db->bind(':orderID', $_GET['id']);
$db->bind(":status", $status);
//request the entire table
$db->execute();
header("Location:employeeViewOrders.php");

?>