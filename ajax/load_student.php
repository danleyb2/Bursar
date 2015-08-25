<?php
require_once '../config/config.php';
require_once '../includes/Database.php';
require_once '../includes/Session.php';


#$sch_id=$_SESSION['school']['id'];
#$_POST['id']=10;

$sql="select id,first_name,last_name,username,school_level as school_form,amount,email,dateAdded,lastUpdated from students where id=$_POST[id]";

$result_set=$database->assoc_array( $database->query_database($sql));
if ($result_set){
    //return $result_set;
    $_SESSION['student']=$result_set;

    echo json_encode($result_set);
}else {
    echo 'no result set';
}
?>

