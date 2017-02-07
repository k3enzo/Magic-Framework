<?php
 
class Router {
	static private $controller,$action,$param;
	static private $url;
	static public $IsRoute;


	static function CheckRoute()
    {
        $controller = self::$controller._Control;

        echo ROOT_PATH.DS.'controller'.DS.$controller.'.php <br>';

        if (file_exists(ROOT_PATH.DS.'controller'.DS.$controller.'.php')) {
            $controllerObj = new $controller();

            if(method_exists($controllerObj, self::$action)){
                call_user_func_array(
                    [$controllerObj,self::$action],
                    !empty(self::$param)? self::$param : []
                );
                self::$IsRoute = 1;
            } else {
                die("Action ".self::$action." not found in $controller Class");
            }

        }
    }





    static function post($url = '',$params = '')
    {

        if(empty($url) && empty($params) && DefaultRouter == 1)
        {
            self::defaultRout("post");
            self::CheckRoute();
        }
        else
        {
            $geturl = $_POST['url'];

            if(strpos($url,"/$")) {

                $parm = self::Exp("/",$geturl);
                $count = count($parm);
                self::$param = [$parm[$count-1]];
                unset($parm[$count-1]);
                $geturl = implode("/",$parm);

                $url = self::ChangeUrl($url);
            }

            if($geturl == $url)
            {
                if(is_callable($params))
                {
                    self::$IsRoute = 1;
                    call_user_func_array($params,[]);
                }
                else {
                    $get = self::Exp("@", $params);

                    self::$controller = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);
                    array_shift($get);
                    self::$action = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);

                    self::CheckRoute();
                }
            }
        }
    }



    static public function get($url = '',$params = '')
    {
        if(empty($url) && empty($params) && DefaultRouter == 1)
        {
            self::defaultRout();
            self::CheckRoute();
        }
        else
        {
            $geturl = $_SERVER['REQUEST_URI'];

            if(strpos($url,"/$")) {
                $parm = self::Exp("/",$geturl);
                $count = count($parm);
                self::$param = [$parm[$count-1]];
                unset($parm[$count-1]);
                $geturl = implode("/",$parm);

                $url = self::ChangeUrl($url);
            }
            if($geturl == $url)
            {
                if(is_callable($params))
                {

                    self::$IsRoute = 1;
                    call_user_func_array($params,[]);
                }
                else {

                    $get = self::Exp("@", $params);

                    self::$controller = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);
                    array_shift($get);
                    self::$action = Helper::Definelow(($get[0] == '') ? 'index' : $get[0]);


                    self::CheckRoute();
                }
            }
        }

    }



    static function route($url = '',$params = ''){

        if(empty($url) && empty($params) && DefaultRouter == 1)
        {
            self::defaultRout();
            self::CheckRoute();
        }
        else
        {
            $geturl = $_SERVER['REQUEST_URI'];

            if(strpos($url,"/$")) {

                $parm = self::Exp("/",$geturl);
                $count = count($parm);
                self::$param = [$parm[$count-1]];
                unset($parm[$count-1]);
                $geturl = implode("/",$parm);


                $url = self::ChangeUrl($url);

            }
            if($geturl == $url)
            {
                if(is_callable($params))
                {

                    self::$IsRoute = 1;
                    call_user_func_array($params,[]);
                }
                else{
                $get = self::Exp("@",$params);

                self::$controller = Helper::Definelow(($get[0] == '' ) ? 'index' : $get[0]);
                array_shift($get);
                self::$action = Helper::Definelow(($get[0] == '' ) ? 'index' : $get[0]);


                self::CheckRoute();
                }
            }
        }



    }

    static private function Exp($tag,$str)
    {
        return explode($tag,$str);
    }

    static private function defaultRout($method = 'Request')
    {
        switch ($method)
        {
            case "get":
                $urlparts = self::Exp("/",$_SERVER['REQUEST_URI']);
                break;
            case "post":
                $urlparts = self::Exp("/",$_SERVER['REQUEST_URI']);
                break;

            default:
                $urlparts = self::Exp("/",$_SERVER['REQUEST_URI']);
                break;
        }
        self::$controller = Helper::Definelow(($urlparts[0] == '' ) ? 'index' : $urlparts[0]);
        array_shift($urlparts);
        self::$action = Helper::Definelow(($urlparts[0] == '' ) ? 'index' : $urlparts[0]);
        array_shift($urlparts);
        self::$param = ($urlparts == '')? '' : $urlparts ;
    }

    static public function ChangeUrl($url)
    {
        $parm = self::Exp("/",$url);
        $count = count($parm);
            unset($parm[$count-1]);
        return implode("/",$parm);
    }

    static public function Run($redirect = "404")
    {
        if(self::$IsRoute != 1)
        {
            Load::viewer($redirect);
        }
    }
}
