## Magic FrameWork

The system is very simple and devoid of any attempt to environmental complexity caused by plug-ins for Basic Systems

PHP Architecture -> MVC



## Introduction

-With Magic You can easily manage all communications between your plugins with the rules properties
-Your URL to easily manage by the MagicRouter
-Easily customize its core


## Installation

Download Project *.zip -> extract 
 
 Next Extract Folder in Root use composer cli in Root Extracted : 

-----------------------------------------------------

$ composer install 

-----------------------------------------------------

got to Library\conf.php    Customize it


## Introducing the Magic FrameWork


## Magic Cli
You can easily use up a lot of exercise and accelerate the work

For Example
   Run in root magic Framework folder Use command line - terminal

    magic $> php magic
next can see option
    magic 1.0 -Dev

    Usage:
      command [options] [arguments]

    Options:
      -h, --help            Display this help message
      -q, --quiet           Do not output any message
      -V, --version         Display this application version
          --ansi            Force ANSI output
          --no-ansi         Disable ANSI output
      -n, --no-interaction  Do not ask any interactive question
      -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

    Available commands:
      help               Displays help for a command
      list               Lists commands
      run                run http server with default localhost:8008
     create
      create:controller  Create Controller with create:controller name
      create:model       Create Model with create:model name

you can use

    magic $> php magic run

now your framework Running in virsual Host

    Magic Running in localhost:8008
now can change nameOf host and port in conf.php file in Library

## Code Example
To manage routers -> Root folder  index.php

All Incoming Urls With Get
	// For Example : mysite.php/site

    
 	  Router::get("/site","Class@function");**

	
	//For Example : mysite.php/site
 	 Router::get("/site","Class@function");
 	 
	// Post :
	  Router::post("/Test","Class@function");
	
	// Request (get & Post) : 
	  Router::route("/article","Class@function");

	// for Get value from url must Write /$ (post,get,route) : 
	  Router::route("/article/$","class@function");

// Warning : When you are in the configuration file into the file / files by default the value is set to 1 DefaultRouter

	defined("DefaultRouter")
            || define("DefaultRouter",1);

	After you default URL is divided into 3 parts : 

	mysite.com/Class/function/value

All Load Methods
	// for Example : Load View file / View File name   ViewName.magic.php
	  **Load::viewer("ViewName");**
	
	// Load Module : 
	  $obj = Load::model("ModuleName");
	
	// Load Other Controllers in a Controller or each part of project
	  $obj = Load::controller('ControllerName');

## Post Requests

can in controller classes get Posted Values from Html and post Routes With 
    Request Class
    Example :

    //What is Requested ? 
      //Requested With Post here ;
        // name() is name of html form   name="name" 
        
         $post = Request::Post();
                        $post->name();

  for check input values and validate That
   can use


    $name =  $post->name('Email|Required');
     if(!$post::$valid){
         echo json_encode(["message" => $post::$message]);
       }

now . you can see when ($post::$valid == false ) then in varible method $post::$message keep a message of you warning from validation

for example response from this test when value is't Email  :

Invalid email format


you can change messages in -> library\Lang.php

## Soon

-Migration Module
-Blade Template Engine
-Join core of communication between plug-ins
-Construction module category to infinity


Don't Stop never just Done for Ever

## License

A short snippet describing the license (MIT, Apache, etc.)
