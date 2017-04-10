<?php

/** @noinspection PhpUndefinedClassInspection */
class Dbase {

    private $_db_host = Dbhost;
    private $_db_name = Dbname;
    private $_db_user = Dbuser;
    private $_db_pass = Dbpass;

    private $_db_object = null;
    private $_db_driver_options = array();
    public $_last_statement;
    public $_affected_rows;
    public $_id;


    public function __construct($dbconn = null) {
        $this->setProperties($dbconn);
        $this->connect();
    }










    protected function setProperties($array = null) {
        if (!empty($array) && is_array($array) && count($array) == 4) {
            foreach($array as $key => $value) {
                $this->$key = $value;
            }
        }
    }









    private function connect() {
        $this->setDriverOptions(array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));
        try {
                $this->_db_object = new PDO(
                    Db.":dbname={$this->_db_name};host={$this->_db_host}",
                    $this->_db_user,
                    $this->_db_pass,
                    $this->_driver_options
            );
        } catch (PDOException $e) {
            die(var_dump($e));
            exit;
        }
    }









    protected function setDriverOptions($options = null) {
        if (!empty($options)) {
            $this->_driver_options = $options;
        }
    }












    private function query($sql = null, $params = null) {

        if (!empty($sql)) {

            $this->_last_statement = $sql;

            if ($this->_db_object == null) {
                $this->connect();
            }

            try {

                $statement = $this->_db_object->prepare($sql, $this->_driver_options);

                $params = self::makeArray($params);

                if (!$statement->execute($params) || $statement->errorCode() != '0000') {
                    $error = $statement->errorInfo();
                    throw new PDOException("Database error {$error[0]} : {$error[2]}, driver error code is {$error[1]}");
                    exit;
                }

                return $statement;

            } catch (PDOException $e) {
                echo $e;
                exit;
            }

        }

    }










    public function formatException($exception = null) {
        if (is_object($exception)) {
            $out = array();
            $out[] = '<strong>Message:</strong> '.$exception->getMessage();
            $out[] = '<strong>Code:</strong> '.$exception->getCode();
            $out[] = '<strong>File:</strong> '.$exception->getFile();
            $out[] = '<strong>Line:</strong> '.$exception->getLine();
            $out[] = '<strong>Trace:</strong> '.$exception->getTraceAsString();
            $out[] = '<strong>Last statement:</strong> '.$this->_last_statement;
            return '<p>'.implode('<br />', $out).'</p>';
        }
    }










    protected function getLastInsertId($sequenceName = null) {
        return $this->_db_object->lastInsertId($sequenceName);
    }










    protected function getAll($sql = null, $params = null) {
        if (!empty($sql)) {
            $statement = $this->query($sql, $params);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }


    protected function GetColumnNames($sql)
    {
        $statement = $this->query($sql, []);
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }









    protected function getOne($sql = null, $params = null) {
        if (!empty($sql)) {
            $statement = $this->query($sql, $params);
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }









    protected function execute($sql = null, $params = null) {
        if (!empty($sql)) {
            $statement = $this->query($sql, $params);
            $this->_affected_rows = $statement->rowCount();
            return true;
        }
        return false;
    }










    protected function insert($sql = null, $params = null) {
        if (!empty($sql)) {
            if ($this->execute($sql, $params)) {
                $this->_id = $this->getLastInsertId();
                return true;
            }
            return false;
        }
        return false;
    }






    protected static function makeArray($array = null) {
        return is_array($array) ? $array : array($array);
    }





}