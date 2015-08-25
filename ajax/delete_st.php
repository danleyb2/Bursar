<?php

require_once 'db_connect.php';

//echo 'deleted '.$_POST['id'];

$q="delete from students where id=$_POST[id] limit 1";

if (isset($connection)){
$result_set=mysqli_query($connection, $q);
if ($result_set){

    echo 1;
}else{
    //fail
    echo 0;
}
}else {
    echo 'No connection to db';
}
?>