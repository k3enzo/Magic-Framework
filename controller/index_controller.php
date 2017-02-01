<?php 

class index_controller extends controller
{

	public function index()
	{
            $post = Request::Post();

            echo "Class Name --> ".get_class($this)."<br>";
                 $post->name('Required|Email');
                    $post->family('Required');

                if(!$post::$valid)
                {
                    echo json_encode(["message" => $post::$message]);
                }





	}
}


