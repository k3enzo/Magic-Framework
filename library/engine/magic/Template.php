<?php
/**
 * Created by PhpStorm.
 * User: Dev K3en Navac
 * Date: 1/2/2017
 * Time: 9:20 AM
 */

class Template{

    protected $contect;
    protected $var;

    function __construct($contect,$var =[])
    {
        $this->contect = $contect;
        $this->var = $var;
    }
    function convertor()
    {
        $cls = get_class_methods(new Template($this->contect));

        foreach ($cls as $row)
        {
            if($row != "__construct" && $row != "convertor")
            {
                $this->$row();
            }
        }

        return $this->contect;


    }

    function cout()
    {
       $this->contect =  str_replace('{',${'<?= '},$this->contect);
       $this->contect =  str_replace('}',${' ?>'},$this->contect);
    }
/*  function cif()
    {
        $this->contect = str_replace("@if",${"<?php if"},$this->contect);
        $this->contect = str_replace(["(","):","==","="],[${"("},${" ): ?>"},${"=="},${"="}],$this->contect);
        $this->contect = str_replace("@endif",${"<?php endif; ?>"},$this->contect);
    } */
    function varset()
    {
        foreach ($this->var as $row => $key )
        {
            foreach ($key as $ss => $s)
            {
                $this->contect = str_replace("$".$row."['$ss']",$s,$this->contect);
            }
        }
    }
}