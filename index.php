<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */

error_reporting(0);

ini_set('internal_encoding', 'utf-8');
ini_set('memory_limit','512M');
ini_set('max_execution_time',0);
ini_set('upload_max_filesize','5M');
ini_set('post_max_size','8M');
ini_set('max_input_time','60');
ini_set('safe_mode','off');
ini_set('max_input_vars','10000');


session_start();
if (!isset($_SESSION['current_project']))
{
    $_SESSION['current_project'] = null;
}

//zip
if (preg_match("/gzip/", strtolower(@$_SERVER['HTTP_ACCEPT_ENCODING'])))
{
    //ob_start("ob_gzhandler");
}

//set global constant
define('EXEC', true);
define('BASE_PATH', dirname(__file__));
define('SYSTEM_PATH', BASE_PATH . '/system/');
define('PROJECT_PATH', BASE_PATH . '/project/');
define('PROJECT_OUTPUT', PROJECT_PATH . '/plugins/');
define('SUPPORT_URL', 'http://cs.ihsana.com/');

if(!file_exists(PROJECT_PATH)){
    mkdir(PROJECT_PATH,0777,true);
}

$content = null;

if (file_exists(BASE_PATH . '/config.php'))
{
    require_once (BASE_PATH . '/config.php');
} else
{
    if ($_GET['page'] != 'preferences')
    {
        header("Location: ./?page=preferences");
    }
}

if (!defined('MAX_METABOX_POSTMETA'))
{
    define('MAX_METABOX_POSTMETA', 10);
}

define('MAX_METABOX_ENUM_OPTION', 5);
define('MAX_OPTION_ENUM_OPTION', 5);


if (!defined('TEMPLATES_CONTAINER'))
{
    define('TEMPLATES_CONTAINER', 'container');
}
if (!defined('PROJECT_LIVE_WP_TEST'))
{
    define('PROJECT_LIVE_WP_TEST', realpath(BASE_PATH . '/../') . '/');
}


//include class generator
require_once (SYSTEM_PATH . '/class/wpGenerator.php');
require_once (SYSTEM_PATH . '/class/wpSampleCode.php');

//include function
require_once (BASE_PATH . '/system/rebuild.php');
require_once (BASE_PATH . '/system/function.php');

//component web
require_once (BASE_PATH . '/system/router.php');
require_once (BASE_PATH . '/system/toolbar.php');


if (!defined('JZ_NO_CONTAINER'))
{
    define('JZ_NO_CONTAINER', false);
}
if (!defined('JZ_FULL_PAGE'))
{
    define('JZ_FULL_PAGE', false);
}

//include templates
require_once (BASE_PATH . '/templates/default.php');

?>