<?php

error_reporting(0);

    /* ----- http Run default root url ------ */
    defined('host')
        || define('host','localhost');

    defined("httpPort")
        || define("httpPort",8008);


    /*------ Database Connection ------ */

    defined("Dbhost")
        || define("Dbhost", "localhost");

    defined("Db")
        || define("Db", "mysql");

    defined("Dbname")
        || define("Dbname", "mvc");

    defined("Dbport")
        || define("Dbport", "3306");

    defined("Dbuser")
        || define("Dbuser", "root");

    defined("Dbpass")
        || define("Dbpass", "");

    /*----- Database Connection End ------*/


 
   define("DS",DIRECTORY_SEPARATOR);
   define("ROOT_PATH",realpath(realpath(dirname(__FILE__)). DS . ".." . DS));

    /*-------   App Directory (This is Database Classes * insert update delete for all action)   -------*/
            defined("App_PATH")
                 ||
                  define("App_PATH",ROOT_PATH.DS.'app');


	/*-------   Model Directory (This is Database Classes * insert update delete for all action)   -------*/
   defined("Model_PATH")
		||
		define("Model_PATH",App_PATH.DS.'model');
		
   /*-------   Controllers Directory (This is All your Actions , Processing and other classes and ... )   -------*/
   defined("Controllers_PATH")
		||
		define("Controllers_PATH",ROOT_PATH.DS.'controller');
		
    /*-------   Library Directory (All your defined php files to include to all project )   -------*/
   defined("Library_PATH")
		||
		define("Library_PATH",ROOT_PATH.DS.'library');
		
	/*-------   View Directory (All your User Interface * html-css  )   -------*/
   defined("View_PATH")
		||
		define("View_PATH",ROOT_PATH.DS.'views');

   defined("Engine_Path")
        ||
        define('Engine_Path',Library_PATH.DS.'engine');

    defined("Engine_Magic_Path")
        ||
        define('Engine_Magic_Path',Engine_Path.DS.'magic');

    defined("Engine_Base_Path")
        ||
        define('Engine_Base_Path',Engine_Path.DS.'base');
    /*------------ require blade ------------ */



/*-------   Suffix Methods   -------*/
	
			/*---- This active all get names and url Convert to low string.  prefix of (controller , module , view ) names   
							| for example : Name_controller.php -> name_controller.php | <?php class Name...* -> name...* |  ---*/
	defined("Strlower")
		||	define("Strlower", 1);
	
	
		/*-------   Suffix Controller (This is controller file extension and class controller extension ) 
						| for example : controller/article_controller.php | <?php class article_controller -------*/
   defined("_Control")
		|| define("_Control","_controller");
		
		/*-------   Suffix Module (This is module file extension and class module extension ) 
						| for example : module/article_module.php | <?php class article_module -------*/
		defined("_Model")
		|| define("_Model","_model");
		
		/*-------   Suffix view (This is view file extension and Your template engine extension's file ) 
						| for example : module/view.magic.php | -------*/
		defined("_View")
		|| define("_View",".magic");



        /*------- default Root (This is for default mvc router redirect )
                   for example mysite.com/article/view/5 -> article = Class | view = Class->function | 5 = input method function view(5) ------ */

        defined("DefaultRouter")
            || define("DefaultRouter",1);




		
  
   
  set_include_path(implode(PATH_SEPARATOR, array(
		realpath(ROOT_PATH),
        realpath(Library_PATH),
        realpath(Engine_Base_Path),
        realpath(Engine_Path),
        realpath(Engine_Magic_Path),
		realpath(App_PATH),
		realpath(Model_PATH),
		realpath(Controllers_PATH),
		get_include_path(),
   )));




  include_once("library".DS."autoload.php");
