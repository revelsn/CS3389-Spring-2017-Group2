<?php


/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 4/1/2017
 * Time: 3:11 PM
 */
function returnUsers() {

    //create database object
    $db = new Database();
    $db->_construct();
    //setup query and bind params
    //get order being worked on
    $db->query('SELECT firstName, lastName, email, telephone, roleID FROM Users');
    //request the entire table
    $table = $db->resultset();
    $html = "";
    //loop through all the items the query found and create some HTML code to show it to the customer
    //this code is almost completely nonfunctional, only for visuals right now.
    foreach ($table as $row) {
        $html .= "<tr><td>"
            .$row['firstName'].
            "</td><td>"
            .$row['lastName'].
            "</td><td>"
            .$row['email'].
            "</td><td>"
            .$row['telephone'].
            "</td><td>"
           
            .$row['roleID'].
            "</td>
			<td>
			<div class='dropdown'>
		  	<button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
		    Role
		    <span class='caret'></span>
		  	</button>
			<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
		    <li><a href='adminUserUpdate.php?id=c&customer=".$row['email']."'>Customer</a></li>
		    <li><a href='adminUserUpdate.php?id=a&customer=".$row['email']."'>Admin</a></li>
			<li><a href='adminUserUpdate.php?id=e&customer=".$row['email']."'>Employee</a></li>
		  	</ul>
			</td></tr>";
    }

    return $html;
}
?>