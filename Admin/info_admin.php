<?php 
session_start();
include ('../php/connect.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../Auth/login_register.php");
    exit;
}

?>


