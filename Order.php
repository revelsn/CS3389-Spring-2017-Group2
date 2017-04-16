<?php

/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/23/2017
 * Time: 3:25 PM
 */
class Order
{
    private $orderID = "";
    private $customerID = "";
    private $employeeID = "";
    private $submitTime = "";
    private $status = "";
    private $pickUpTime = "";
    private $customerName = "";
    private $runningTotal = "0.00";
    private $numItems = 0;

    /**
     * 
     * @return number|integer
     */
    public function getNumItems()
    {
    	return $this->numItems;
    }
    /**
     * 
     * @param integer $numItems
     */
    public function setNumItems($numItems)
    {
    	$this->numItems = $numItems;
    }
    
    
    /**
     * @return string
     */
    public function getCustomerName()
    {

        return $this->customerName;
    }

    /**
     * @param string $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }


    /**
     * @return string
     */
    public function getRunningTotal()
    {
        return $this->runningTotal;
    }

    /**
     * @param string $runningTotal
     */
    public function setRunningTotal($runningTotal)
    {
        $this->runningTotal = $runningTotal;
    }



    /**
     * @return string
     */
    public function getOrderID()
    {
        return $this->orderID;
    }

    /**
     * @param string $orderID
     */
    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;
    }

    /**
     * @return string
     */
    public function getCustomerID()
    {
        return $this->customerID;
    }

    /**
     * @param string $customerID
     */
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;
    }

    /**
     * @return string
     */
    public function getEmployeeID()
    {
        return $this->employeeID;
    }

    /**
     * @param string $employeeID
     */
    public function setEmployeeID($employeeID)
    {
        $this->employeeID = $employeeID;
    }

    /**
     * @return string
     */
    public function getSubmitTime()
    {
        return $this->submitTime;
    }

    /**
     * @param string $timeStamp
     */
    public function setSubmitTime($submitTime)
    {
        $this->submitTime = $submitTime;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getPickUpTime()
    {
        return $this->pickUpTime;
    }

    /**
     * @param string $pickUpTime
     */
    public function setPickUpTime($pickUpTime)
    {
        $this->pickUpTime = $pickUpTime;
    }
    
    function orderReset()
    {
    	$this->setCustomerID(null);
    	$this->setCustomerName(null);
    	$this->setEmployeeID(null);
    	$this->setNumItems(null);
    	$this->setOrderID(null);
    	$this->setPickUpTime(null);
    	$this->setRunningTotal(null);
    	$this->setStatus(null);
    	$this->setSubmitTime(null);
    	
    }
    
    function submit($date)
    {
    	$db = new Database();
    	$db->_construct();
    	//setup query and bind params
    	$db->query('UPDATE Orders SET pickupTime = :date, status = "Submitted" WHERE orderID = :orderID');
    	$db->bind(':orderID', $this->orderID);
    	$db->bind(':date', $date);
    	//request the entire table
    	$db->execute();
    }

    /**
     * This method returns a string containing html of table rows
     * for every item currently in their order
     * @return string - html code
     */
    function returnCurrentOrderItems($pagename)
    {

        //create database object
        $db = new Database();
        $db->_construct();
        //setup query and bind params
        $db->query('SELECT i.itemID, i.itemName, ol.quantity, ol.totalPrice FROM OrderLine ol INNER JOIN Items i ON ol.itemID=i.itemID INNER JOIN Orders o ON o.orderID=ol.orderID WHERE customerID = :customerID AND o.orderID = :orderID');
        $db->bind(':customerID', $_SESSION["user"]);
        $db->bind(":orderID", $this->getOrderID());
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
					<td><a href='".$pagename.".php?delete=".$row['itemID']."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></td>
                  </tr>";
        }

        return $html;

    }
    
    function deleteItem($item)
    {
    	$db = new Database();
    	$db->_construct();
    	//setup db connection
    	
    	//setup query and bind params, been copied out to logout.php, may need to be pulled out to class.
    	$db->query('SELECT orderID FROM Orders WHERE customerID = :customerID AND status = "In Progress"');
    	$db->bind(':customerID', $this->getCustomerID());
    	//request the single row
    	$row = $db->single();
    	$this->setOrderID($row['orderID']);
    	
    	//to get total price a select to grab the price of the item is necessary from the items table
    	$db->query('SELECT price FROM Items WHERE itemID = :itemID');
    	$db->bind(':itemID', $item);
    	$itemPrice = $db->single();
    	
    	//check if item is in order already, if yes then increment, if not then insert line
    	$db->query('SELECT EXISTS(SELECT * FROM OrderLine WHERE itemID = :itemID AND orderID = :orderID) AS "itemExists"');
    	$db->bind(':itemID', $item);
    	$db->bind(':orderID', $this->getOrderID());
    	$itemExists = $db->single();
    	//check if item exists in the order already
    	if ($itemExists['itemExists'] == 1) {
    		
    		$db->query('DELETE FROM OrderLine WHERE orderID = :orderID AND itemID = :itemID');
    		$db->bind(':itemID', $item);
    		$db->bind(':orderID', $this->getOrderID());
    		$db->execute();
    		
    	}
    	//set running Order total
    	//setup query and bind params, been copied out to logout.php, may need to be pulled out to class.
    	$db->query('SELECT sum(totalPrice) as "total" FROM OrderLine WHERE orderID = :orderID;');
    	$db->bind(':orderID', $this->getOrderID());
    	$total = $db->single();
    	$this->setRunningTotal($total['total']);
    }

    /**
     * This method creates an order for the customer attaches it to their id,
     * and adds the first item they selected to the orderline table in the db.
     */
    function createOrder()
    {
        //create database object
        $db = new Database();
        $db->_construct();
        //setup query, bind params, and execute
        $db->query('INSERT INTO Orders (customerID) VALUES (:customerID)');
        $db->bind(':customerID', $this->getCustomerID());
        $db->execute();
        //create an order
        //$order = new Order();
        //setup query and bind params
        $db->query('SELECT orderID, customerID, employeeID, submitTime, status, pickUpTime FROM Orders WHERE customerID = :user AND status = "In Progress"');
        //request the entire table
        $db->bind(':user', $this->getCustomerID());
        $row = $db->single();

        $this->setOrderID($row['orderID']);
        $this->setEmployeeID($row['employeeID']);
        $this->setSubmitTime($row['submitTime']);
        $this->setStatus($row['status']);
        $this->setPickUpTime($row['pickUpTime']);

        //to get total price a select to grab the price of the item is necessary from the items table
        $db->query('SELECT price FROM Items WHERE itemID = :itemID');
        $db->bind(':itemID', $_GET['itemID']);
        $itemPrice = $db->single();

        //Now add the item to the order by inserting into OrderLine table
        $db->query('INSERT INTO OrderLine (orderID, itemID, quantity, totalPrice) VALUES (:orderID, :itemID, 1, :totalPrice)');
        $db->bind(':orderID', $this->getOrderID());
        $db->bind(':itemID', $_GET['itemID']);
        $db->bind(':totalPrice', $itemPrice['price']);
        $db->execute();

        //set running Order total
        //setup query and bind params, been copied out to logout.php, may need to be pulled out to class.
        $db->query('SELECT sum(totalPrice) as "total" FROM OrderLine WHERE orderID = :orderID;');
        $db->bind(':orderID', $this->getOrderID());
        $total = $db->single();
        $this->setRunningTotal($total['total']);
    }

    /**
     * This method adds an item to an order that already exists and is in progress.
     */
    function addToOrder() {
        $db = new Database();
        $db->_construct();
        //setup db connection

        //setup query and bind params, been copied out to logout.php, may need to be pulled out to class.
        $db->query('SELECT orderID FROM Orders WHERE customerID = :customerID AND status = "In Progress"');
        $db->bind(':customerID', $this->getCustomerID());
        //request the single row
        $row = $db->single();
        $this->setOrderID($row['orderID']);

        //to get total price a select to grab the price of the item is necessary from the items table
        $db->query('SELECT price FROM Items WHERE itemID = :itemID');
        $db->bind(':itemID', $_GET['itemID']);
        $itemPrice = $db->single();

        //check if item is in order already, if yes then increment, if not then insert line
        $db->query('SELECT EXISTS(SELECT * FROM OrderLine WHERE itemID = :itemID AND orderID = :orderID) AS "itemExists"');
        $db->bind(':itemID', $_GET['itemID']);
        $db->bind(':orderID', $this->getOrderID());
        $itemExists = $db->single();
        //check if item exists in the order already
        if ($itemExists['itemExists'] == 1) {
            //if so, then increment quantity
            $db->query('UPDATE OrderLine SET quantity = quantity + 1 WHERE itemID = :itemID AND orderID = :orderID');
            $db->bind(':itemID', $_GET['itemID']);
            $db->bind(':orderID', $this->getOrderID());
            $db->execute();
            $db->query('UPDATE OrderLine o SET o.totalPrice = (SELECT price FROM Items i WHERE o.itemID=i.itemID)*quantity');
            $db->execute();
        } else {
            //if not, then add to order
            $db->query('INSERT INTO OrderLine (orderID, itemID, quantity, totalPrice) VALUES (:orderID, :itemID, 1, :totalPrice)');
            $db->bind(':orderID', $this->getOrderID());
            $db->bind(':itemID', $_GET['itemID']);
            $db->bind(':totalPrice', $itemPrice['price']);
            $db->execute();
        }

        //set running Order total
        //setup query and bind params, been copied out to logout.php, may need to be pulled out to class.
        $db->query('SELECT sum(totalPrice) as "total" FROM OrderLine WHERE orderID = :orderID;');
        $db->bind(':orderID', $this->getOrderID());
        $total = $db->single();
        $this->setRunningTotal($total['total']);
    }

    /**
     * This method returns the total of the order, multiplying item price with quantity
     * and summing together all orderlines for this order received from the db.
     */
    function updateRunningTotal() {

        $db = new Database();
        $db->_construct();
        //create db object

        $db->query('SELECT sum(totalPrice) as "total" FROM OrderLine WHERE orderID = :orderID;');
        $db->bind(':orderID', $this->getOrderID());
        $total = $db->single();
        $this->setRunningTotal($total['total']);


        //TODO Total seems to be working well except when user closes webpage then logs back in,
        //TODO when a user does this then the total is shown as the first item in the list, not the total
        //TODO May try killing two birds by logging users out and then back in when they closed the browser window,
        //TODO which may require additional table to maintain sessions or column in users table.
    }

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
        foreach ($table as $row) {
            $html .= "<tr>
                    <td>".$row['orderID']."</td>
                    <td>".$row['submitTime']."</td>
                    <td>".$row['pickUpTime']."</td>
                    <td>" ."Items in Order..."."</td>
                    <td>"."Price..."."</td>
                    </tr>";
        }

        return $html;
    }
    
    
}



