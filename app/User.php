<?php
/**
 * Created by PhpStorm.
 * User: rpm
 * Date: 4/10/17
 * Time: 3:09 PM
 */

class User extends model
{
    protected $table = 'User';
    protected $fields = ['username','password','email','ip','remember'];
    protected $pk = 'id';
}