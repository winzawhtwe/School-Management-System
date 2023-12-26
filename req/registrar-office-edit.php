<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['fname'])      &&
    isset($_POST['lname'])      && 
    isset($_POST['Username'])   &&
    isset($_POST['r_user_id'])  &&
    isset($_POST['address'])         &&
    isset($_POST['employee_number']) &&
    isset($_POST['phone_number'])    &&
    isset($_POST['qualification'])   &&
    isset($_POST['email_address'])   &&
    isset($_POST['gender'])          &&
    isset($_POST['date_of_birth'])) {

    include '../DB_connection.php';
    include '../admin/data/registrar-office.php';
    // include '../admin/data/class.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['Username'];

    $address = $_POST['address'];
    $employee_number = $_POST['employee_number'];
    $phone_number = $_POST['phone_number'];
    $qualification = $_POST['qualification'];
    $email_address = $_POST['email_address'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];

    $r_user_id = $_POST['r_user_id'];

    // $class = "";
    // foreach ($_POST['class'] as $class) {
    //     $class .=$class;
    // }
    // // echo $class;

    // $subject = "";
    // foreach ($_POST['subject'] as $subject) {
    //     $subject .=$subject;
    // }

    $data = 'r_user_id='.$r_user_id;

    if (empty($fname)) {
        $em = "First name is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($lname)) {
        $em = "Last name is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($uname)) {
        $em = "Username is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (!unameIsUnique($uname, $conn, $r_user_id)) {
        $em = "Username is taken! try another";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($address)) {
        $em = "Address is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($employee_number)) {
        $em = "Employee number is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($phone_number)) {
        $em = "Phone number is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($qualification)) {
        $em = "Qualification is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em = "Email address is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em = "Gender is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em = "Date of birth is required";
        header("Location: ../admin/registrar-office-edit.php?error=$em&$data");
        exit;
    }else {
        $sql = "UPDATE registrar_office SET
                username=?, fname=?, lname=?, address=?, employee_number=?,
                date_of_birth=?, phone_number=?, qualification=?, gender=?, email_address=?
                WHERE r_user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $fname, $lname, $address, $employee_number, 
                        $date_of_birth, $phone_number, $qualification, $gender, $email_address,
                        $r_user_id]);
        $sm = "Successfully updated!";
        header("Location: ../admin/registrar-office-edit.php?success=$sm&$data");
        exit;
    }

    }else {
        $em = "Error occured";
        header("Location: ../admin/registrar-office.php?error=$em");
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