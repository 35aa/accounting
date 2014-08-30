<?php

//define application root path
define('APPLICATION_ROOT_PATH', realpath(dirname(__FILE__) . '/..'));
//define application path
define('APPLICATION_PATH', APPLICATION_ROOT_PATH.'/accounting');
//define config path
define('APPLICATION_CONFIG_PATH', APPLICATION_PATH.'/configs');

//define app enf (could be devel, test, staging, prod)
//if env not defined we believe we on production
//this will help prevent showing errors in case we encountered problems with envs on prod.
defined('APPLICATION_ENV')
	|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') 
																? getenv('APPLICATION_ENV')
																: 'prod' ));

//we require only this one file to be included manually to run zend app
//all other files will be loaded using Zend autoloader
require_once 'Zend/Application.php';

//instantiate Zend App object
$application = new Zend_Application(
	APPLICATION_ENV,
	APPLICATION_CONFIG_PATH . '/application.ini'
);

//configure app through Bootstrap and run it
$application->bootstrap(array('Date', 'FrontController', 'DB', 'Auth'))->run();
