<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role']) &&
    isset($_GET['r_user_id'])) {

    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/registrar-office.php";

        $id = $_GET['r_user_id'];
        if (removeR_user($id, $conn)) {
            $sm = "Successfully deleted!";
            header("Location: registrar-office.php?success=$sm");
            exit;
        }else {
            $em = "Unknown error occured!";
            header("Location: registrar-office.php?error=$em");
            exit;
        }

    }else {
        header("Location: admin/registrar-office.php");
        exit;
    } 

}else {
        header("Location: admin/registrar-office.php");
        exit;
} 