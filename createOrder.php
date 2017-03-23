<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/23/2017
 * Time: 4:58 PM
 */
//create database object
$db = new Database();
$db->_construct();
//setup query, bind params, and execute
$db->query('INSERT INTO Orders (customerID) VALUES (:customerID)');
$db->bind(':customerID', $_SESSION["user"]);
$db->execute();
//create an order
$order = new Order();
//setup query and bind params
$db->query('SELECT orderID, customerID, employeeID, submitTime, status, pickUpTime FROM Orders WHERE customerID = :user AND status = "In Progress"');
//request the entire table
$db->bind(':user', $_SESSION["user"]);
$row = $db->single();

$order->setOrderID($row['orderID']);
$order->setEmployeeID($row['employeeID']);
$order->setSubmitTime($row['submitTime']);
$order->setStatus($row['status']);
$order->setPickUpTime($row['pickUpTime']);

$_SESSION['activeOrder'] = $order;
//TODO This is where the cart comes into play. The cart has to grab the order info,
//TODO look up order lines and output them
?>