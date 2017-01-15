<?php

class Router
{
    static private $controller, $action, $param;
    static private $url;
    static public $IsRoute;


    static function CheckRoute()
    {
        $controller = self::$controller . _Control;

        echo ROOT_PATH . DS . 'controller' . DS . $controller . '.php <br>';

        if (file_exists(ROOT_PATH . DS . 'controller' . DS . $controller . '.php')) {
            $controllerObj = new $controller();

            if (method_exists($controllerObj, self::$action)) {
                call_user_func_array(
                    [$controllerObj, self::$action],
                    self::$param ?? []
                );
                self::$IsRoute = 1;
            } else {
                die("Action " . self::$action . " not found in $controller Class");
            }

        }
    }


<<<<<<< HEAD



    static function post($url = '',$params = '')
=======
    static function post($url = '', $params = '')
>>>>>>> eaf074becc19bc90a287f32a6bad2c5bfaf4b6e5
    {

        if (empty($url) && empty($params) && DefaultRouter == 1) {
            self::defaultRout("post");
            self::CheckRoute();
        } else {
            $geturl = @$_POST['url'];

            if (strpos($url, "/$")) {

                $parm = self::Exp("/", $geturl);
                $count = count($parm);
                self::$param = [$parm[$count - 1]];
                unset($parm[$count - 1]);
                $geturl = implode("/", $parm);


                $url = self::ChangeUrl($url);

            }
<<<<<<< HEAD
            if("/".$geturl == $url)
            {
                if(is_callable($params))
                {
                    self::$IsRoute = 1;
                    call_user_func_array($params,[]);
                }
                else {
=======
            if ("/" . $geturl == $url) {
                if (is_callable($params)) {
                    self::$IsRoute = 1;
                    return $params();
                } else {
>>>>>>> eaf074becc19bc90a287f32a6bad2c5bfaf4b6e5
                    $get = self::Exp("@", $params);

                    self::$controller = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);
                    array_shift($get);
                    self::$action = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);


                    self::CheckRoute();
                }
            }

        }
    }


    static public function get($url = '', $params = '')
    {
        if (empty($url) && empty($params) && DefaultRouter == 1) {
            self::defaultRout();
            self::CheckRoute();
        } else {
            $geturl = $_GET['url'];

<<<<<<< HEAD
            if(strpos($url,"/$")) {
                $parm = self::Exp("/",$geturl);
=======
            if (strpos($url, "/$")) {

                $parm = self::Exp("/", $geturl);
>>>>>>> eaf074becc19bc90a287f32a6bad2c5bfaf4b6e5
                $count = count($parm);
                self::$param = [$parm[$count - 1]];
                unset($parm[$count - 1]);
                $geturl = implode("/", $parm);

                $url = self::ChangeUrl($url);
            }
<<<<<<< HEAD
            if("/".$geturl == $url)
            {
                if(is_callable($params))
                {

                    self::$IsRoute = 1;
                    call_user_func_array($params,[]);
                }
                else {
=======
            if ("/" . $geturl == $url) {
                if (is_callable($params)) {
                    self::$IsRoute = 1;
                    return $params();
                } else {
                    $get = self::Exp("@", $params);

                    self::$controller = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);
                    array_shift($get);
                    self::$action = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);
>>>>>>> eaf074becc19bc90a287f32a6bad2c5bfaf4b6e5

                    $get = self::Exp("@", $params);

<<<<<<< HEAD
                    self::$controller = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);
                    array_shift($get);
                    self::$action = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);


=======
>>>>>>> eaf074becc19bc90a287f32a6bad2c5bfaf4b6e5
                    self::CheckRoute();
                }
            }
        }

    }


    static function route($url = '', $params = '')
    {


        if (empty($url) && empty($params) && DefaultRouter == 1) {
            self::defaultRout();
            self::CheckRoute();
        } else {
            $geturl = $_REQUEST['url'];

            if (strpos($url, "/$")) {

                $parm = self::Exp("/", $geturl);
                $count = count($parm);
                self::$param = [$parm[$count - 1]];
                unset($parm[$count - 1]);
                $geturl = implode("/", $parm);


                $url = self::ChangeUrl($url);

            }
<<<<<<< HEAD
            if("/".$geturl == $url)
            {
                if(is_callable($params))
                {

                    self::$IsRoute = 1;
                    call_user_func_array($params,[]);
                }
                else{
                $get = self::Exp("@",$params);
=======
            if ("/" . $geturl == $url) {
                if (is_callable($params)) {
                    self::$IsRoute = 1;
                    return $params();
                } else {
                    $get = self::Exp("@", $params);
>>>>>>> eaf074becc19bc90a287f32a6bad2c5bfaf4b6e5

                    self::$controller = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);
                    array_shift($get);
                    self::$action = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);


<<<<<<< HEAD
                self::CheckRoute();
=======
                    self::CheckRoute();
>>>>>>> eaf074becc19bc90a287f32a6bad2c5bfaf4b6e5
                }
            }


        }

    }


    static private function Exp($tag, $str)
    {
        return explode($tag, $str);
    }

    static private function defaultRout($method = 'Request')
    {
        switch ($method) {
            case "get":
                $urlparts = self::Exp("/", $_GET['url']);
                break;
            case "post":
                $urlparts = self::Exp("/", $_POST['url']);
                break;

            default:
                $urlparts = self::Exp("/", $_REQUEST['url']);
                break;
        }


        self::$controller = Helper::Definelow(($urlparts[0] == '') ? 'index' : $urlparts[0]);
        array_shift($urlparts);
        self::$action = Helper::Definelow(($urlparts[0] == '') ? 'index' : $urlparts[0]);
        array_shift($urlparts);
        self::$param = ($urlparts == '') ? '' : $urlparts;

    }

    static public function ChangeUrl($url)
    {
        $parm = self::Exp("/", $url);
        $count = count($parm);
        unset($parm[$count - 1]);
        return implode("/", $parm);
    }

    static public function Run($redirect = "404")
    {
        if (self::$IsRoute != 1) {
            Load::viewer($redirect);
        }
    }


}