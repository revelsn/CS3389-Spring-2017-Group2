<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/20/2017
 * Time: 4:47 PM
 */
function returnInStockInv() {

    $DB_HOST = '35.184.123.250';
    $DB_NAME = 'wigglydb';
    $DB_USER = 'web';
    $DB_PASSWORD = 'kMC`NX,<NcCk!>7E';
//setup for creating PDO
    $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
//create PDO
    $pdo = new PDO($dsn, $DB_USER, $DB_PASSWORD, $opt);
//prepare SQL statement and execute looking for items in stock that the customer can buy
    $stmt = $pdo->prepare('SELECT itemName, price, outOfStock FROM Items WHERE outOfStock = 0') or die ('Unable to execute query. '. mysqli_error($dsn));
    $stmt->execute();
    $table = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = "";
    //loop through all the items the query found and create some HTML code to show it to the customer
    //this code is almost completely nonfunctional, only for visuals right now.
    foreach ($table as $row) {
        $html .= " <div class=\"col-md-3\">
            <h3><span class=\"label label-info\" style=\"display: block\">".
            $row['itemName'].
            "</span></h3><img alt='Bootstrap Image Preview' src='grocery_dummy.jpg' class='img-responsive center-block'/>
                    <button type='button' class='btn btn-block btn-info'>Add to Cart</button></div>";
    }

    return $html;
}

?>