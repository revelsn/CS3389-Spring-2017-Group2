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
    $db->bind(':customerID', $_SESSION["user"]);
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
?>