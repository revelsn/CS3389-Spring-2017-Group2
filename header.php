<?php
	session_start(); //start the session. if there's already an exisiting session, it will be continued
	include "Database.php";
	include "Order.php";
	include "DBInventory.php";
	echo '';
	if ((!isset($_SESSION["user"]) || $_SESSION['role'] != 0) && !stristr($_SERVER["PHP_SELF"], 'login')) {
		require_once('logout.php');
		header("location:login.php?err=3");
		die();
	}
	$order = "";
	//include the database connection stuff so we don't have to duplicate it everywhere
	if (!stristr($_SERVER["PHP_SELF"], 'login')) {
		//unserialize order if set else create new order object.
		
		if (!isset($_SESSION['currentOrder'])) {
			$order = new Order();
		} else {
			$order = unserialize($_SESSION['currentOrder']);
		}
		
		//if user just added an item then add to order
		if(isset($_GET['action']) && $_GET['action']=="add") {
			//check to see if customer is creating a new order or adding to order
			if (!isset($_SESSION['currentOrder'])) {
				//Customer is adding the first item to an order, so we need to create an order in the db,
				//create an orderLine in the db for this item, and attach the order to this customer
				$order->setCustomerID($_SESSION['user']);
				$order->createOrder();
			} else {
				$order->addToOrder();
				
			}
			$_SESSION['currentOrder'] = serialize($order);
		}
	}

		

echo '<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Login page">
	<meta name="author" content="Wiggly Piggly Family Store">

	<title>Login for Wiggly Piggly</title>
	<!-- jQuery (necessary for Bootstrap"s JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
			
			<!-- Custom styles for this template -->
			<link href="signin.css" rel="stylesheet">
			<!-- Optional theme -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
			
			<!-- Latest compiled and minified JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
			<!-- Validation Script-->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
	
	</head>
<body>
<!-- The closing tags are on the footer.php page which is also included on all pages  -->';
?>
