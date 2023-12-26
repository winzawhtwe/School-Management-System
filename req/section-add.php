<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['section'])) {

    include '../DB_connection.php';

    $section = $_POST['section'];
    

    $data = 'section='.$section;

    if (empty($section)) {
        $em = "Section is required";
        header("Location: ../admin/section-add.php?error=$em&$data");
        exit;
    }else {

        $sql = "INSERT INTO
                section(section)
                VALUES(?)"; 

        $stmt = $conn->prepare($sql);
        $stmt->execute([$section]);
        $sm = "New section added successfully!";
        header("Location: ../admin/section-add.php?success=$sm");
        exit;
    }

    }else {
        $em = "Error occured";
        header("Location: ../admin/section-add.php?error=$em");
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