<?php

	    include_once("library/conf.php");

        Router::get("/",function (){
            return Load::viewer('users');
        });


            Router::group("/sos",function (){

                        Router::get("/salam","users@view");
                        Router::get("/bye","users@view");

            });


        Router::get("/users","users@view");

        Router::route("/article/$","article@view");

        Router::get("/khodemoni",function (){
            return Load::viewer('home');
        });
         Router::Run("404");








