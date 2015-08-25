<?php
require_once '../config/config.php';

if (!isset($connection)){
$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,'bursar');
}
?>