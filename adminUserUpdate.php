<?php
include 'header.php';
//create database object
$db = new Database();
$db->_construct();
if ($_GET['id'] == 'c') {
	$status = "C";
} elseif ($_GET['id'] == 'a') {
	$status = "A";
} elseif ($_GET['id'] == 'e') {
	$status = "E";
}
$db->query('UPDATE Users SET roleID=:status WHERE email=:email');
$db->bind(':status', $status);
$db->bind(':email', $_GET['customer']);
$db->execute();
header("Location:AdminUsers.php");

?>