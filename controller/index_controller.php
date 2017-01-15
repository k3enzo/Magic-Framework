<?php 

class index_controller extends controller
{

	public function index()
	{
            $post = Request::Post();
                $post->name();
            echo "Class Name --> ".get_class($this)."<br>";




	}
}


