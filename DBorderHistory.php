<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 4/1/2017
 * Time: 3:11 PM
 */
function returnOrderHistory() {

    //create database object
    $db = new Database();
    $db->_construct();
    //setup query and bind params
    //get order being worked on
    $db->query('SELECT * FROM Orders WHERE customerID = :customerID AND status = "Picked Up"');
    $db->bind(':customerID', $_SESSION["user"]);
    //request the entire table
    $table = $db->resultset();
    $html = "";
    //loop through all the items the query found and create some HTML code to show it to the customer
    //this code is almost completely nonfunctional, only for visuals right now.
    foreach ($table as $row) {
        $html .= "<tr><td>"
            .$row['orderID'].
            "</td><td>"
            .$row['submitTime'].
            "</td><td>"
            .$row['status'].
            "</td><td>"
            .$row['pickUpTime'].
            "</td><td>"
            ."Items in Order...".
            "</td><td>"
            ."Price...".
            "</td><td>"
            .
            "</td></tr>";
    }

    return $html;
}