<?php

require_once '../config/config.php';
require_once '../includes/Database.php';
require_once '../includes/Session.php';
require_once '../includes/student.php';


$sch_id=$_SESSION['school']['id'];

//print_r($_POST);
$student=Student::instantiate($_POST);
unset($_POST);


if ($student){
    $student->add_new();
    echo $student->first_name." ". $student->last_name." added";
}



?>