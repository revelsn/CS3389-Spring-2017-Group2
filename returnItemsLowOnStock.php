<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 4/1/2017
 * Time: 3:11 PM
 */
function returnItemsLowOnStock() {
    //create database object
    $db = new Database();
    $db->_construct();
    //setup query and bind params
    //get order being worked on
    $db->query('SELECT itemID, itemName, image, categoryID, price, outOfStock, quantity FROM Items WHERE quantity <= 5');
    //$db->bind(':customerID', $_SESSION["user"]);
    //request the entire table
    $table = $db->resultset();
    $html = "";
    //loop through all the items the query found and create some HTML code to show it to the customer
    //this code is almost completely nonfunctional, only for visuals right now.
    foreach ($table as $row) {
        $html .= "<tr><td>"
            .$row['itemID'].
            "</td><td>"
            .$row['itemName'].
            "</td><td>"
            .$row['image'].
            "</td><td>"
            .$row['categoryID'].
            "</td><td>"
            .$row['price'].
            "</td><td>"
            .$row['outOfStock'].
            "</td><td>"
            .$row['quantity'].
            "</td><td>"
            .
            "</td></tr>";
    }
    return $html;
}
