<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/24/2017
 * Time: 12:52 PM
 */
$db = new Database();
$db->_construct();
//create an order

//setup query and bind params, been copied out to logout.php, may need to be pulled out to class.
$db->query('SELECT orderID FROM Orders WHERE customerID = :customerID AND status = "In Progress"');
$db->bind(':customerID', $_SESSION["user"]);
//request the entire table
$row = $db->single();

//to get total price a select to grab the price of the item is necessary from the items table
$db->query('SELECT price FROM Items WHERE itemID = :itemID');
$db->bind(':itemID', $_GET['itemID']);
$itemPrice = $db->single();

//check if item is in order already, if yes then increment, if not then insert line
$db->query('SELECT EXISTS(SELECT * FROM OrderLine WHERE itemID = :itemID AND orderID = :orderID) AS "itemExists"');
$db->bind(':itemID', $_GET['itemID']);
$db->bind(':orderID', $row['orderID']);
$itemExists = $db->single();
//check if item exists in the order already
if ($itemExists['itemExists'] == 1) {
    //if so, then increment quantity
    $db->query('UPDATE OrderLine SET quantity = quantity + 1 WHERE itemID = :itemID AND orderID = :orderID');
    $db->bind(':itemID', $_GET['itemID']);
    $db->bind(':orderID', $row['orderID']);
    $db->execute();
    $db->query('UPDATE OrderLine o SET o.totalPrice = (SELECT price FROM Items i WHERE o.itemID=i.itemID)*quantity');
    $db->execute();
} else {
    //if not, then add to order
    $db->query('INSERT INTO OrderLine (orderID, itemID, quantity, totalPrice, outOfStock) VALUES (:orderID, :itemID, 1, :totalPrice, 0)');
    $db->bind(':orderID', $row['orderID']);
    $db->bind(':itemID', $_GET['itemID']);
    $db->bind(':totalPrice', $itemPrice['price']);
    $db->execute();
}


//TODO Insert Item line attached to order already in db
?>