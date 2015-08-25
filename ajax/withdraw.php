<?php
require_once '../config/config.php';
include_once '../includes/Database.php';
require_once '../includes/Session.php';
require_once '../includes/Student.php';

/**
 * todo:include sch_id in query
 */

echo Student::withdraw($_POST['withd_amount'],$_POST['id']);

?>