<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/24/2017
 * Time: 11:43 AM
 */
function returnCurrentOrderItems() {

        //create database object
        $db = new Database();
        $db->_construct();
        //setup query and bind params
        $db->query('SELECT i.itemName, quantity, totalPrice FROM OrderLine ol INNER JOIN Items i ON ol.itemID=i.itemID INNER JOIN Orders o ON o.orderID=ol.orderID WHERE customerID = :customerID');
        $db->bind(':customerID', $_SESSION["user"]);
        //request the entire table
        $table = $db->resultset();

        $html = "";
        //loop through all the items the query found and create some HTML code to show it to the customer
        //this code is almost completely nonfunctional, only for visuals right now.
        foreach ($table as $row) {
            $html .= "<tr>
                    <td>" . $row['itemName'] . "</td>
                    <td>$" . $row['totalPrice'] . "</td>
                    <td>" . $row['quantity'] . "</td>
                  </tr>";
        }

        return $html;

}

?>