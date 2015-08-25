<?php
/**
 * TODO:include School id in querry to delete transaction item data
 */
require_once '../config/config.php';
require_once '../includes/Database.php';
require_once '../includes/Transaction.php';
//require_once 'db_connect.php';

//echo 'deleted '.$_POST['id'];

$q="delete from transactions where id=$_POST[id] limit 1";
$transactions->delete_tr($_POST['id']);

/*
if (isset($connection)){
    $result_set=mysqli_query($connection, $q);
    if ($result_set){
        echo 1;
    }else{
        //fail
        echo 1;
    }
}else {
    echo 'No connection to db';
}*/
?>