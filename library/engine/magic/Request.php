<?php
/**
 * Created by PhpStorm.
 * User: Dev K3en Navac
 * Date: 1/11/2017
 * Time: 7:30 PM
 */
class Request
{
    static public $Post = [];
    static public $Name = [];
    static public $s;


    public function __construct()
    {
        foreach ($_POST as $row => $key)
        {
            $this->$row = create_function( '', 'return '.$key.';');
//            self::$Post[$row] = $key;
//            self::$Name[] = $row;
        }

    }
    public function __call($method, $args)
    {
        if(property_exists($this, $method)) {
            if(is_callable($this->$method)) {
                return call_user_func_array($this->$method, $args);
            }
        }
    }


    static private function Geter($post)
    {

    }
    static public function Post()
    {
        return new Request();
    }
}