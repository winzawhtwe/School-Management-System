<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['fname'])           &&
    isset($_POST['lname'])           && 
    isset($_POST['Username'])        &&
    isset($_POST['pass'])            &&
    isset($_POST['address'])         &&
    isset($_POST['employee_number']) &&
    isset($_POST['phone_number'])    &&
    isset($_POST['qualification'])   &&
    isset($_POST['email_address'])   &&
    isset($_POST['gender'])          &&
    isset($_POST['date_of_birth'])) {

    include '../DB_connection.php';
    include '../admin/data/registrar-office.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['Username'];
    $pass = $_POST['pass'];

    $address = $_POST['address'];
    $employee_number = $_POST['employee_number'];
    $phone_number = $_POST['phone_number'];
    $qualification = $_POST['qualification'];
    $email_address = $_POST['email_address'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];

    // $class = "";
    // foreach ($_POST['class'] as $class) {
    //     $class .=$class;
    // }

    // $subject = "";
    // foreach ($_POST['subject'] as $subject) {
    //     $subject .=$subject;
    // }
    $data = 'uname='.$uname.'&fname='.$fname.'&lname='.$lname.'&address='.$address.'&en='.$employee_number.
            '&pn='.$phone_number.'&qf='.$qualification.'&email='.$email_address;
            //'&gender='.$gender.'&date_of_birth='.$date_of_birth;//

    if (empty($fname)) {
        $em = "First name is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($lname)) {
        $em = "Last name is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($uname)) {
        $em = "Username is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (!unameIsUnique($uname, $conn)) {
        $em = "Username is taken! try another";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($address)) {
        $em = "Address is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($employee_number)) {
        $em = "Employee number is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($phone_number)) {
        $em = "Phone number is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($qualification)) {
        $em = "Qualification is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em = "Email address is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em = "Gender is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em = "Date of birth is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($pass)) {
        $em = "Password is required";
        header("Location: ../admin/registrar-office-add.php?error=$em&$data");
        exit;
    }else {
        // hashing the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO
                registrar_office (username, password, fname, lname, address, employee_number, date_of_birth,
                        phone_number, qualification, gender, email_address)
                VALUES(?,?,?,?,?,?,?,?,?,?,?)"; //11

        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $pass, $fname, $lname, $address, $employee_number, $date_of_birth,
                        $phone_number, $qualification, $gender, $email_address]);
        $sm = "New user registered successfully!";
        header("Location: ../admin/registrar-office-add.php?success=$sm");
        exit;
    }

    }else {
        $em = "Error occured";
        header("Location: ../admin/registrar-office-add.php?error=$em");
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