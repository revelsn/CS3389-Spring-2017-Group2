<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 4/1/2017
 * Time: 3:11 PM
 */
function returnInventory() {
    //create database object
    $db = new Database();
    $db->_construct();
    //setup query and bind params
    //get order being worked on
    $db->query('SELECT * FROM Items i INNER JOIN Category c on i.categoryID=c.categoryID ORDER BY itemName');
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
            .$row['description'].
            "</td><td>"
            .$row['categoryName'].
            "</td><td>"
            .$row['price'].
            "</td><td>"
            .$row['quantity'].
            "</td></tr>";
    }
    return $html;
}
