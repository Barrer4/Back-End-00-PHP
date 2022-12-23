<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'peliculas');

//xampp/htdocs/peliculas/includes
defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
defined('SVC_PATH') ? null : define('SVC_PATH', SITE_ROOT.DS.'api' .DS.'services');
defined('CLS_PATH') ? null : define('CLS_PATH', SITE_ROOT.DS.'api' .DS.'classes');

//load the config file
require_once(CLS_PATH.DS.'db.php');

//core classes
require_once(CLS_PATH.DS.'movie.php');
require_once(CLS_PATH.DS.'category.php');
require_once(CLS_PATH.DS.'director.php');
require_once(CLS_PATH.DS.'year.php');
require_once(CLS_PATH.DS.'title.php');
require_once(CLS_PATH.DS.'actor.php');
require_once(CLS_PATH.DS.'country.php');