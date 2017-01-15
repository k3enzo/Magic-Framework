## Magic FrameWork

The system is very simple and devoid of any attempt to environmental complexity caused by plug-ins for Basic Systems

PHP Architecture -> MVC



## Introduction

-With Magic You can easily manage all communications between your plugins with the rules properties
-Your URL to easily manage by the MagicRouter
-Easily customize its core


## Installation

Download Project *.zip -> extract -> use composer cli in Root Extracted : composer install 

got to Library\conf.php    Customize it

run in Apachi |-)


## Introducing the Magic FrameWork
	
## Code Example

To manage routers -> Root folder  index.php

----------------------------------------------
All Incoming Urls With Get   
	// For Example : mysite.php/site
	
 	  Router::get("/site","Class@function");**
=======
	
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
----------------------------------------------
All Load Methods
	// for Example : Load View file / View File name   ViewName.magic.php
	  Load::viewer("ViewName"); 
	
	// Load Module : 
	  $obj = Load::model("ModuleName");
	
	// Load Other Controllers in a Controller or each part of project
	  $obj = Load::controller('ControllerName'); 
----------------------------------------------

Read the description **soon**


## Soon

-Migration Module
-Blade Template Engine
-Join core of communication between plug-ins
-Construction module category to infinity


## License

A short snippet describing the license (MIT, Apache, etc.)
