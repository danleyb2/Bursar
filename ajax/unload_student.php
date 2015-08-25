<?php

if (isset($_SESSION['student'])){
    unset($_SESSION['student']);
    return true;
}
?>
