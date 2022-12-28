<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define('SITE_ROOT', '');
defined('BASE_URL') ? null : define('BASE_URL', '');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
defined('LAYOUT_PATH') ? null : define('LAYOUT_PATH', SITE_ROOT.DS.'layouts');
defined('WHITELIST') ? null : define('WHITELIST', []);
defined('IS_DEMO') ? null : define('IS_DEMO', false);

//Define Contstants
defined('STANDARD_USER') ? null : define('STANDARD_USER', 0);
defined('ADMINISTRATOR') ? null : define('ADMINISTRATOR', 1);

//load configuration file
require_once(LIB_PATH.DS.'config.php');

//load functions
require_once(LIB_PATH.DS.'functions.php');

//load objects
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');
require_once(LIB_PATH.DS.'session.php');

//load database related classes
require_once(LIB_PATH.DS.'category.php');
require_once(LIB_PATH.DS.'favorite.php');
require_once(LIB_PATH.DS.'recipe.php');
require_once(LIB_PATH.DS.'user.php');
