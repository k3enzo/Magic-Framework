<?php 

class index_controller extends controller
{

	public function index()
	{

		echo "Class Name --> ".get_class($this)."<br>";

		$name = Request::Post();

		echo $name['name'];

	}
}


