<?php
require_once '../config/config.php';
require_once '../includes/Database.php';
require_once '../includes/Session.php';
require_once '../includes/student.php';

$result_set=Student::st_check($_POST['student_name'],$_POST['student_pass']);
if ($result_set){
    $_SESSION['student']=$result_set;

    /*{

    student_name:$result_set['first_name']." ".$result_set['last_name'];
    student_form:$result_set['school_form'];
    amount:$result_set['amount'];

    }  */

    echo json_encode($result_set);



    /**
    <?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");

    $result = $conn->query("SELECT CompanyName, City, Country FROM Customers");

    $outp = "[";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
        if ($outp != "[") {$outp .= ",";}
        $outp .= '{"Name":"'  . $rs["CompanyName"] . '",';
        $outp .= '"City":"'   . $rs["City"]        . '",';
        $outp .= '"Country":"'. $rs["Country"]     . '"}';
    }
    $outp .="]";

    $conn->close();

    echo($outp);
    ?>
    */



}else {
    echo "Wrong Password Username combination<br>Try again or Sign Up the student";
}
die();