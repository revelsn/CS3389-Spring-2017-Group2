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
//create new order object to assign into session when logic completes
$order = new Order();
//set customer var in order to current user
$order->setCustomerID($_SESSION['user']);
$db->query('SELECT itemID, quantity FROM OrderLine WHERE orderID = :orderID');
$db->bind(":orderID", $_GET['reorder']);
//now grab all item from the order we are copying
$items = $db->resultset();
//if the quantity of an item is greater than 1 set get var and create order
if ((int)current($items)['quantity'] > 1) {
	$_GET['itemID'] = current($items)['itemID'];
	$order->createOrder();
	for ($x = 0; $x < (int)current($items)['quantity']-1; $x++) {
		$_GET['itemID'] = current($items)['itemID'];
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