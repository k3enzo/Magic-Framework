<?php

	    include_once("library/conf.php");

        Router::get("/",function (){
            return Load::viewer('users');
        });

        Router::get("/users","users@view");

        Router::route("/article/$","article@view");

        Router::get("/khodemoni",function (){
            return Load::viewer('home');
        });
         Router::Run("404");








