<?php

	include_once("library/conf.php");


    Router::route("/",function (){ return Load::viewer("users.user");});
        Router::route("/users","users@view");
        Router::route("/article/1","article@index");

//    Router::get("/khodemoni","index@index");

    Router::Run("404");






