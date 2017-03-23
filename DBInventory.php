<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/20/2017
 * Time: 4:47 PM
 */
function returnInStockInv() {

    //create database object
    $db = new Database();
    $db->_construct();
    //setup query and bind params
    $db->query('SELECT itemID, itemName, price, outOfStock FROM Items WHERE outOfStock = 0');
    //request the entire table
    $table = $db->resultset();

    $html = "";
    //loop through all the items the query found and create some HTML code to show it to the customer
    //this code is almost completely nonfunctional, only for visuals right now.
    foreach ($table as $row) {
        $html .= " <div class=\"col-md-3\">
            <h3><span class=\"label label-info\" style=\"display: block\">".
            $row['itemName'].
            "</span></h3><img alt='Bootstrap Image Preview' src='grocery_dummy.jpg' class='img-responsive center-block'/>
                   <a href='customerDash.php?action=add&itemID=" . $row['itemID'] . "' class='btn btn-default btn-block'>Add to Cart</a></div>";
    }

    return $html;
}

?>