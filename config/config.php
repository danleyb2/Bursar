<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 6/23/15
 * Time: 4:47 PM
 */



define('DB_HOST',getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PASSWORD', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));
define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));


?>

