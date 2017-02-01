<?php
/**
 * Created by PhpStorm.
 * User: k3en
 * Date: 12/08/2016
 * Time: 11:25 PM
 */
class View extends Base{

    private $vars = array();

    function set($var , $data) {
        $this->vars[$var] = $data;
    }

    function render($view) {
        Helper::Fixview($view);
        extract($this->vars);

            ob_start();
                include View_PATH.DS.$view._View.'.php';
                $view = $contents = ob_get_contents();
            ob_end_clean();

//        $view = file_get_contents(View_PATH.DS.$view._View.'.php',FILE_USE_INCLUDE_PATH);

        $template = new Template($view,$this->vars);
        $show = $template->convertor();
        echo $show;

    }

}
