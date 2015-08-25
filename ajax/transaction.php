<?php require_once '../includes/Student.php';?>

<?php
/**
 * 1-Withdraw
 *
 * 2-Recharge
 * TODO:rename file and all reference to new_transaction.php
 */

if (isset($_POST['submit'])){

    switch ($_POST['tr_state']){
        case 1:
            echo Student::withdraw($_POST['tr_amount']);
        break;
        case 2:
            echo Student::recharge($_POST['tr_amount']);
        break;
    }

}

?>

