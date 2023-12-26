<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['fname'])      &&
    isset($_POST['lname'])      && 
    isset($_POST['Username'])   &&
    isset($_POST['teacher_id']) &&
    isset($_POST['address'])         &&
    isset($_POST['employee_number']) &&
    isset($_POST['phone_number'])    &&
    isset($_POST['qualification'])   &&
    isset($_POST['email_address'])   &&
    isset($_POST['gender'])          &&
    isset($_POST['date_of_birth'])   &&
    isset($_POST['subject'])         &&
    isset($_POST['class'])) {

    include '../DB_connection.php';
    include '../admin/data/teacher.php';

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

    $teacher_id = $_POST['teacher_id'];

    $class = "";
    foreach ($_POST['class'] as $class) {
        $class .=$class;
    }

    $subject = "";
    foreach ($_POST['subject'] as $subject) {
        $subject .=$subject;
    }

    $data = 'teacher_id='.$teacher_id;

    if (empty($fname)) {
        $em = "First name is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($lname)) {
        $em = "Last name is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($uname)) {
        $em = "Username is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (!unameIsUnique($uname, $conn, $teacher_id)) {
        $em = "Username is taken! try another";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($address)) {
        $em = "Address is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($employee_number)) {
        $em = "Employee number is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($phone_number)) {
        $em = "Phone number is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($qualification)) {
        $em = "Qualification is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em = "Email address is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em = "Gender is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em = "Date of birth is required";
        header("Location: ../admin/teacher-edit.php?error=$em&$data");
        exit;
    }else {
        $sql = "UPDATE teacher SET
                username=?, class=?, fname=?, lname=?, subject=?, address=?, employee_number=?,
                date_of_birth=?, phone_number=?, qualification=?, gender=?, email_address=?
                WHERE teacher_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $class, $fname, $lname, $subject, $address, $employee_number, 
                        $date_of_birth, $phone_number, $qualification, $gender, $email_address,
                        $teacher_id]);
        $sm = "Successfully updated!";
        header("Location: ../admin/teacher-edit.php?success=$sm&$data");
        exit;
    }

    }else {
        $em = "Error occured";
        header("Location: ../admin/teacher.php?error=$em");
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