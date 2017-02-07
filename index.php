<?php

	include_once("library/conf.php");

    Router::get("/",function (){
        return Load::viewer('users');
    });

        Router::get("/users/ss","users@view");

        Router::route("/article/1","article@index");

        Router::post("/khodemoni","index@index");

         Router::Run("404");








