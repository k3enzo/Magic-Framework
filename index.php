<?php

	    include_once("library/conf.php");

        Router::get("/",function (){
            return Load::viewer('users');
        });

        Router::get("/users/ss","users@view");

        Router::route("/article/$","article@view");

        Router::get("/khodemoni","index@index");

         Router::Run("404");








