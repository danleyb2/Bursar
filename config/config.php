<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 6/23/15
 * Time: 4:47 PM
 */

/*

TODO:configure to autodetect deployment and development env

*/



$host= getenv('OPENSHIFT_MYSQL_DB_HOST');

if ($host) {

define('DB_HOST',$host);
define('DB_PASSWORD', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));
define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
}else {

define('DB_NAME','bursar');
define('DB_HOST','localhost');
define('DB_PASSWORD','brian123');
define('DB_USER','brian');

}

?>
<?php
/*

$mysql_host = "mysql13.000webhost.com";
$mysql_database = "a9132393_bursar";
$mysql_user = "a9132393_brian";
$mysql_password = "brian123";
*/
?>
<?php

/*
if (!defined('DB_HOST')){define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));}
if (!defined('DB_PASSWORD')){define('DB_PASSWORD', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));}
if (!defined('DB_NAME')){define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));}
if (!defined('DB_USER')){define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));}

*/
?>
