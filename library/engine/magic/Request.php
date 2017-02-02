<?php
/**
 * Created by PhpStorm.
 * User: Dev K3en Navac
 * Date: 1/11/2017
 * Time: 7:30 PM
 */
class Request extends Validate
{
    static public $Post = [];
    static public $Name = [];
    static public $s;


    public function __construct()
    {
        foreach ($_POST as $row => $key)
        {
            $this->$row = create_function('$validate = NULL',
                ' if(!empty($validate))
                    {
                      $obj = new Validate();
                        $obj::Option($validate,"'.$key.'","'.$row.'");
                            if(!$obj::$valid)
                               {
                                    return $obj::$message;
                               }
                               return "'.$key.'";
                    }
                   return "'.$key.'" ;'
                );
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

    static public function Post()
    {
        return new Request();
    }
}