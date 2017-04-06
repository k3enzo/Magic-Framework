<?php 
class users_controller extends controller
{

    public function view()
    {

        Load::viewer("users", ['var' => "hello", 'data' => ['message' => "mss"]]);
    }

    public function shows($s)
    {
        echo $s;
    }
}