<?php

abstract class Helper
{
	static public function Do_array($array)
	{
		return (!is_array($array))? array($array) : $array ;
	}
	static public function Definelow($string)
	{
		return (
				(Strlower == 1) ? strtolower($string) : $string
		);
	}
	static public function Fixview($view)
    {
        return str_replace(".",DS,$view);
    }
	static public function refactor($var,$char = NULL)
	{
		if(is_array($var))
			return implode(!empty($char)?"{$char}":',',$var);
		else
			return explode(!empty($char)?"{$char}":',',$var);
	}
}
