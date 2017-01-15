<?php 

class index_controller extends controller
{

	public function index()
	{
            $post = Request::Post();

            echo "Class Name --> ".get_class($this)."<br>";

            var_dump($post->name("Required|Email|Max:2"));


	}
}


