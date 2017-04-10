<?php
/**
 * Created by PhpStorm.
 * User: rpm
 * Date: 4/10/17
 * Time: 3:12 PM
 */

abstract class Auth extends controller
{
    static public function login($user,$pass)
    {
       $model = (new User())
                    ->where('username',$user)
                    ->where('password',$pass)
                ->get(1);

        if(!empty($model['username']))
        {
            session_regenerate_id();
            $_SESSION[Auth_Conf['UserId']] = $model['id'];
            $_SESSION[Auth_Conf['UserN']] = $model['username'];
            $_SESSION[Auth_Conf['UserIp']] = $model['ip'];


            $set = Auth_Conf['RedirectToIn'];

            $help = Helper::refactor($set,':');

            if($help[0] == "view")
                Load::viewer($help[1]);
            elseif($help[0] == "route")
                Helper::Jump($help[1]);
            else
                Load::viewer(Auth_Conf['RedirectToIn']);
        }
        else
        {
            echo Login_Invalid_UserPw;
        }
    }

    static public function check()
    {
        if(!isset($_SESSION)
            or empty($_SESSION[Auth_Conf['UserId']])
            or empty($_SESSION[Auth_Conf['UserN']]))
        {
            return False;
        }

        if(SecureMode == 'Hard')
        {
            $select = (new User())
                ->where('username',$_SESSION[Auth_Conf['UserN']])
                ->where('id',$_SESSION[Auth_Conf['UserId']])
                ->get(1);
            if(empty($select['id']) or !ctype_digit($select['id']))
                return false;
        }

        return true;
    }

    static public function logOut()
    {
        if(SecureMode == 'Hard') {

            if(!empty($_SESSION[Auth_Conf['UserId']])) {
                unset($_SESSION[Auth_Conf['UserId']]);
                unset($_SESSION[Auth_Conf['UserN']]);
                unset($_SESSION[Auth_Conf['UserIp']]);
                session_destroy();
                ob_clean();
            }

        }else{
            session_destroy();
        }

        $set = Auth_Conf['RedirectToOut'];

        $help = Helper::refactor($set,':');

        if($help[0] == "view")
            Load::viewer($help[1]);
        elseif($help[0] == "controller")
            Helper::Jump($help[1]);
        else
            Load::viewer(Auth_Conf['RedirectToOut']);
    }

}