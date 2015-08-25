<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 6/23/15
 * Time: 4:47 PM
 */

if (!defined(__ROOT__))define('__ROOT__', dirname(__DIR__));

if (!defined('DB_HOST')){define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));}
if (!defined('DB_PASSWORD')){define('DB_PASSWORD', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));}
if (!defined('DB_NAME')){define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));}
if (!defined('DB_USER')){define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));}


?>

