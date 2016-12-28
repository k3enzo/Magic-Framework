<?php
/**
 * Created by PhpStorm.
 * User: k3en
 * Date: 12/08/2016
 * Time: 11:25 PM
 */
class View {

    private $vars = array();

    function set($var , $data) {
        $this->vars[$var] = $data;
    }

    function render($view) {
        extract($this->vars);
        include_once View_PATH.DS.$view._View.'.php';
    }

}