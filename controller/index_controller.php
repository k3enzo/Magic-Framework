<?php 

class index_controller extends controller
{

	public function index()
	{

            $post = Request::Post();

                    echo $post->name('Email');
                     echo $post->family('Required');

                if(!$post::$valid)
                {
                    echo json_encode(["message" => $post::$message]);
                }


        }
}


