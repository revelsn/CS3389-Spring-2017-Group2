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

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

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
    public function execute(){
        return $this->stmt->execute();
    }
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