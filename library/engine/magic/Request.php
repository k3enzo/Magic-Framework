<?php
/**
 * Created by PhpStorm.
 * User: Dev K3en Navac
 * Date: 1/11/2017
 * Time: 7:30 PM
 */
class Request
{
    static private $Post = [];
    static public $Name = [];

    static private function Geter($post)
    {
        foreach ($post as $row => $key)
        {
            self::$Post[$row] = $key;
            self::$Name[] = $row;
        }
    }
    static public function Post()
    {
        if(isset($_POST))
        {
           self::Geter($_POST);

           return self::$Post;
        }
    }
}