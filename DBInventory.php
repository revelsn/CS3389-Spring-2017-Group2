<?php
/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/20/2017
 * Time: 4:47 PM
 */
function returnEmployeeInv() {
	
	//create database object
	$db = new Database();
	$db->_construct();
	//setup query and bind params
	$db->query('SELECT i.itemID, i.itemName, i.price, c.categoryName FROM Items i INNER JOIN Category c ON i.categoryID=c.categoryID ORDER BY i.itemName');
	//request the entire table
	$table = $db->resultset();
	
	$html = "";
	//loop through all the items the query found and create some HTML code to show it to the customer
	foreach ($table as $row) {
		$html .= "<div class=\"col-md-3\">
            <h3>
			<span class=\"label label-info\" style=\"display: block\">".
			$row['itemName'].
			"</span>
			<img alt='Bootstrap Image Preview' src='grocery_dummy.jpg' class='img-responsive center-block'/>
			<span class=\"label label-warning\" >$".
			$row['price'].
			"</span>
			<span class=\"label label-info\" >".
			$row['categoryName'].
			"</h3>
            <a href='customerDash.php?action=add&itemID=" . $row['itemID'] . "' class='btn btn-default btn-block'>Add to Cart</a>
            </div>";
	}
	
	return $html;
}

function returnInStockInv() {

    //create database object
    $db = new Database();
    $db->_construct();
    //setup query and bind params
    $db->query('SELECT i.itemID, i.itemName, i.price, c.categoryName FROM Items i INNER JOIN Category c ON i.categoryID=c.categoryID ORDER BY i.itemName');
    //request the entire table
    $table = $db->resultset();

    $html = "";
    //loop through all the items the query found and create some HTML code to show it to the customer
    foreach ($table as $row) {
        $html .= "<div class=\"col-md-3\">
            <h3>
			<span class=\"label label-info\" style=\"display: block\">".
            $row['itemName'].
            "</span>
			<img alt='Bootstrap Image Preview' src='grocery_dummy.jpg' class='img-responsive center-block'/>
			<span class=\"label label-warning\" >$".
            $row['price'].
            "</span>
			<span class=\"label label-info\" >".
			$row['categoryName'].
			"</h3>
            <a href='customerDash.php?action=add&itemID=" . $row['itemID'] . "' class='btn btn-default btn-block'>Add to Cart</a>
            </div>";
    }

    return $html;
}

function itemSearch() {
	
	//create database object
	$db = new Database();
	$db->_construct();
	//setup query and bind params
	$db->query('SELECT i.itemID, i.itemName, i.price, i.outOfStock, c.categoryName FROM Items i INNER JOIN Category c ON i.categoryID=c.categoryID WHERE itemName LIKE :search AND outOfStock = "N"');
	$db->bind(':search', '%'.$_POST['search'].'%');
	$items = $db->resultset();
	
	$html = "";
	//loop through all the items the query found and create some HTML code to show it to the customer
	foreach ($items as $row) {
		$html .= "<div class=\"col-md-3\">
            <h3>
			<span class=\"label label-info\" style=\"display: block\">".
			$row['itemName'].
			"</span>
			<img alt='Bootstrap Image Preview' src='grocery_dummy.jpg' class='img-responsive center-block'/>
			<span class=\"label label-warning\" >$".
			$row['price'].
			"</span>
			<span class=\"label label-info\" >".
			$row['categoryName'].
			"</h3>
            <a href='customerDash.php?action=add&itemID=" . $row['itemID'] . "' class='btn btn-default btn-block'>Add to Cart</a>
            </div>";
	}
	
	return $html;
	
	
}

function returnItemsByCategory() {
	
	//create database object
	$db = new Database();
	$db->_construct();
	//setup query and bind params
	$db->query('SELECT i.itemID, i.itemName, i.price, i.outOfStock, c.categoryName FROM Items i INNER JOIN Category c ON i.categoryID=c.categoryID WHERE c.categoryName LIKE :search AND outOfStock = "N"');
	$db->bind(':search', '%'.$_GET['category'].'%');
	$items = $db->resultset();
	
	$html = "";
	//loop through all the items the query found and create some HTML code to show it to the customer
	foreach ($items as $row) {
		$html .= "<div class=\"col-md-3\">
            <h3>
			<span class=\"label label-info\" style=\"display: block\">".
			$row['itemName'].
			"</span>
			<img alt='Bootstrap Image Preview' src='grocery_dummy.jpg' class='img-responsive center-block'/>
			<span class=\"label label-warning\" >$".
			$row['price'].
			"</span>
			<span class=\"label label-info\" >".
			$row['categoryName'].
			"</h3>
            <a href='customerDash.php?action=add&itemID=" . $row['itemID'] . "' class='btn btn-default btn-block'>Add to Cart</a>
            </div>";
	}
	
	return $html;
	
}

function returnCategories() {
	
	$db = new Database();
	$db->_construct();
	
	$db->query('SELECT categoryName FROM Category');
	$categories = $db->resultset();
	
	$html = "";
	//loop through all the items the query found and create some HTML code to show it to the customer
	foreach ($categories as $category) {
		$html .= "<li><a href='customerDash.php?category=".$category['categoryName']."'>".$category['categoryName']."</a></li>";
	}
	
	return $html;
}

function returnCategoriesSelect() {
	
	$db = new Database();
	$db->_construct();
	
	$db->query('SELECT * FROM Category');
	$categories = $db->resultset();
	
	$html = "";
	//loop through all the items the query found and create some HTML code to show it to the customer
	foreach ($categories as $category) {
		$html .= "<option value='".$category['categoryID']."'>".$category['categoryName']."</option>";
	}
	
	return $html;
}

?>