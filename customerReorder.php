<?php
include 'header.php';
//create database object
$db = new Database();
$db->_construct();
//setup query and bind params
//get order being worked on
$db->query('SELECT * FROM Orders WHERE orderID = :orderID');
$db->bind(':orderID', $_GET['reorder']);
//request the entire table
$table = $db->single();

$order = new Order();
$order->setCustomerID($_SESSION['user']);
$db->query('SELECT itemID, quantity FROM OrderLine WHERE orderID = :orderID');
$db->bind(":orderID", $_GET['reorder']);
$items = $db->resultset();
if ((int)$item['quantity'] > 1) {
	$_GET['itemID'] = current($items)['itemID'];
	$order->createOrder();
	(int)current($items)['quantity']--;
	for ($x = 0; $x < (int)current($items)['quantity']; $x++) {
		$_GET['itemID'] = current($items)['quantity'];
		$order->addToOrder();
	}
	array_shift($items);
} else {
	$_GET['itemID'] = array_shift($items)['itemID'];
	$order->createOrder();
}


foreach ($items as $item) {
	for ($x = 0; $x < (int)$item['quantity']; $x++) {
		$_GET['itemID'] = $item['itemID'];
		$order->addToOrder();
	} 
	
}
$_SESSION['currentOrder'] = serialize($order);
header("Location:customerOrderSubmit.php");

?>