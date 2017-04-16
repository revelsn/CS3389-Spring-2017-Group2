<?php
include "header.php";

	$date = $_POST['date'];
	$time = $_POST['time'].':00';
	$date_pieces = explode( '-', $date);
	
	$time_pieces = explode( ':', $time);
	
	$mysql_timestamp = date( 'Y-m-d H:i:s', mktime(
			$time_pieces[0], // Hour
			$time_pieces[1], // Minute
			$time_pieces[2], // Second
			$date_pieces[0], // Month
			$date_pieces[1], // Day
			$date_pieces[2])); // year
			
			$order->submit($mysql_timestamp);
			$order->orderReset();
			header("Location:logout.php");

?>