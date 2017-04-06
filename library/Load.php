<?php
/**
 * Created by PhpStorm.
 * User: k3en
 * Date: 12/08/2016
 * Time: 08:29 PM
 */
Class Load
{
    static public function model($model)
    {
        if(file_exists(Model_PATH.DS.$model._Model.".php"))
        {
            $model .=_Model;
            return new $model();
        }
            exit(Not_Model);
    }
    static public function controller($control)
    {
        if(file_exists(Controllers_PATH.DS.$control._Control.".php"))
        {
            $control .=_Control;
            return new $control();
        }
            exit(Not_Control);
    }

    static public function viewer($file,$set =['var'=>'','data' => []])
    {
        $view = new View();
        $data = !is_array($set['data'])? [$set['data']] : $set['data'];
        $view->set($set['var'],$data);
        $view->render($file);
    }
}