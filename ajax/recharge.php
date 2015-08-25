<?php
require_once '../config/config.php';
require_once '../includes/Database.php';
require_once '../includes/Session.php';
require_once '../includes/student.php';
/**
 * TODO:include sch_id in ajax calls
 */
echo Student::recharge($_POST['recharge_amount'],$_POST['id']);
?>