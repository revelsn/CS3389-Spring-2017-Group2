<?php

/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/23/2017
 * Time: 3:25 PM
 */
class Order
{
    var $orderID = "";
    var $customerID = "";
    var $employeeID = "";
    var $submitTime = "";
    var $status = "";
    var $pickUpTime = "";
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

}