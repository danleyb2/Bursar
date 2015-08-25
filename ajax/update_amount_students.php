<?php



require_once '../config/config.php';
include_once '../includes/Database.php';
require_once '../includes/Session.php';
include_once '../includes/school.php';

$student_data=array('allStudents'=>$school::all_students(),'totalAmount'=>$school::total_amount());
echo json_encode($student_data);

?>