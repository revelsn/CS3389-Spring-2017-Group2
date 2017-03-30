<?php

/**
 * Created by PhpStorm.
 * User: EDWid
 * Date: 3/23/2017
 * Time: 3:58 PM
 */
if (!defined("DB_HOST"))
    define("DB_HOST", "35.184.123.250");
if (!defined("DB_USER"))
define("DB_USER", "web");
if (!defined("DB_PASS"))
define("DB_PASS", "kMC`NX,<NcCk!>7E");
if (!defined("DB_NAME"))
define("DB_NAME", "wigglydb");

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh = "";
    private $error = "";
    private $stmt = "";

    /**
     * This method constructs the database connection and needs to be called before
     * any other methods are used in this class
     */
    public function _construct()
    {
        //Set DSN
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        //Set options
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        //Create a new PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } //Catch errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    /**
     * This method sets up a query for this database, no params are dealt with here.
     * @param $query - this is the string that will be sent to the db
     */
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * This method binds params to values and sets the type with the last param
     * @param $param - this is the param in the query
     * @param $value - this is the value that should be filled in the query
     * @param null $type - this is the type of the value inserted into the query
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);

    }

    /**
     * This method executes the query to the db
     * @return mixed - returns from the db an array of values from the db, either multi dimensional
     * or single
     */
    public function execute(){
        return $this->stmt->execute();
    }

    /**
     * This method returns a multidimensional array
     * @return mixed
     */
    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}