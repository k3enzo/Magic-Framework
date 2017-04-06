<?php 

class index_controller extends controller
{

	public function index()
	{

            $post = Request::Post();

        $name =  $post->name('Email');
        $family = $post->family('Required');

                echo $name." | ".$family;

                if(!$post::$valid)
                {
                    echo json_encode(["message" => $post::$message]);
                }
        }
}


