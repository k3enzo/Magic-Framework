<?php

	include_once("library/conf.php");



    Router::get("/","index@index");

    Router::route("/users","users@view");

    Router::route("/article/1","article@index");

    Router::post("/khodemoni","index@index");

    Router::Run();






