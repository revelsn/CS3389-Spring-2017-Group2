<?php
function isCurrency($number)
{
	return preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $number);
}

include "header.php";

//create database object
$db = new Database();
$db->_construct();
//setup query and bind params
if ($_POST['itemName'] == "" || $_POST['description'] == "" || $_POST['Categories'] == "" || !isCurrency($_POST['price']) || $_POST['quantity'] == "") {
	$_GET['err']=1;
	header("location:viewInventory.php?err=1");
} else {
	$itemName= filter_var($_POST['itemName'], FILTER_SANITIZE_STRING);
	$description= filter_var($_POST['description'], FILTER_SANITIZE_STRING);
	$categories= filter_var($_POST['Categories'], FILTER_SANITIZE_STRING);
	$price= $_POST['price'];
	$quantity= filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);
	
	$db->query('INSERT INTO Items (itemName, description, categoryID, price) VALUES (:itemName, :description, :category, :price)');
	$db->bind(":itemName", $itemName);
	$db->bind(":description", $description);
	$db->bind(":category", $categories);
	$db->bind(":price", $price);
	$db->execute();
	header("location:viewInventory.php");
}





		
		?>