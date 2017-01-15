<?php

class Validate
{
    static public $message = [];
    static public $valid = true;
    static public $num;

    static public function Option($opt,$value,$name)
    {
        $opt = str_replace(" ","",$opt);
        $exp = explode("|",$opt);
        self::$message[] = [ $name => $value];
            foreach ($exp as $row)
            {
                $rowFunc = explode(":",$row);
                if(!empty($rowFunc[1]))
                {
                    $row = $rowFunc[0];
                    self::$row($value,$name,$rowFunc[1]);
                }
                else
                {
                   self::$row($value,$name);
                }
            }
    }

    private function check()
    {
        if(self::$valid == true) {
            self::$num +=1;
            self::$valid = false;
        }
    }
    static public function Email($value,$name)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            self::$message[] =[ 'Email' => $name." ".Email_Not_Valid];
            self::check();
        }
    }
    static public function Required($value,$name)
    {
        if(empty($value))
        {
            self::$message[] = [ "Required" => $name." ".Not_Required];
            self::check();
        }
    }
    static public function Int($value,$name)
    {
        if(!is_numeric($value))
        {
            self::$message[] = [ "Int" => $name." ".Not_Int ];
            self::check();
        }
    }
    static public function Max($value,$name,$size)
    {
        if(strlen($value) > $size)
        {
            self::$message[] = ["Max" => $name." ".Max_Invalid." ".$size];
            self::check();
        }
    }
    static public function Min($value,$name,$size)
    {
        if(strlen($value) < $size)
        {
            self::$message[] = ["Min" => $name." ".Min_Invalid." ".$size];
            self::check();
        }
    }
    static public function StartStr($value,$name,$start)
    {
         $size = strlen($start);
            $get = substr($value,0,$size);

         if($get != $start)
         {
             self::$message = ["StartStr" => $name." ".Not_StartedValue." ".$start];
             self::check();
         }
    }
    static public function EndStr($value,$name,$end)
    {
        $sizeEnd = strlen($end);
        $sizeValue = strlen($value);

        $size = $sizeValue - $sizeEnd;
        $get = substr($value,$size,$sizeValue);

        if($get != $end)
        {
            self::$message = ["EndStr" => $name." ".Not_EndedValue." ".$end];
            self::check();
        }
    }

}