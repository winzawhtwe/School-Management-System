<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['admin_pass'])   &&
    isset($_POST['new_pass'])     && 
    isset($_POST['c_new_pass'])   &&
    isset($_POST['r_user_id'])) {

    include '../DB_connection.php';
    include '../admin/data/registrar-office.php';
    include '../admin/data/admin.php';

    $admin_pass = $_POST['admin_pass'];
    $new_pass = $_POST['new_pass'];
    $c_new_pass = $_POST['c_new_pass'];

    $r_user_id = $_POST['r_user_id'];
    $id = $_SESSION['admin_id'];

    $data = 'r_user_id='.$r_user_id.'#change_password';

    if (empty($admin_pass)) {
        $em = "Admin password is required";
        header("Location: ../admin/registrar-office-edit.php?perror=$em&$data");
        exit;
    }else if (empty($new_pass)) {
        $em = "New Password is required";
        header("Location: ../admin/registrar-office-edit.php?perror=$em&$data");
        exit;
    }else if (empty($c_new_pass)) {
        $em = "Confirmation password is required";
        header("Location: ../admin/registrar-office-edit.php?perror=$em&$data");
        exit;
    }else if ($new_pass !== $c_new_pass) {
        $em = "New password and confirm password does not match";
        header("Location: ../admin/registrar-office-edit.php?perror=$em&$data");
        exit;
    }else if (!adminPassword_verify($admin_pass, $conn, $id)) {
        $em = "Incorrect admin password";
        header("Location: ../admin/registrar-office-edit.php?perror=$em&$data");
        exit;
    }else {
        // hashing the password
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE registrar_office SET
                password = ?
                WHERE r_user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_pass, $r_user_id]);
        $sm = "The password has been changed successfully!";
        header("Location: ../admin/registrar-office-edit.php?psuccess=$sm&$data");
        exit;
    }

    }else {
        $em = "Error occured";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    } 
    }else {
        header("Location: ../../logout.php");
        exit;
    } 

}else {
        header("Location: ../../logout.php");
        exit;
} 