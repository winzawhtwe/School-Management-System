<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['section']) &&
    isset($_POST['section_id']))    {

    include '../DB_connection.php';
    include '../admin/data/section.php';

    $section = $_POST['section'];
    $section_id = $_POST['section_id'];

    $data = 'section='.$section.'&section_id='.$section_id;

    if (empty($section)) {
        $em = "Section name is required";
        header("Location: ../admin/section-edit.php?error=$em&$data");
        exit;
    }else {
        $sql = "UPDATE section SET
                section = ?
                WHERE section_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$section, $section_id]);
        $sm = "Successfully updated!";
        header("Location: ../admin/section-edit.php?success=$sm&$data");
        exit;
    }

    }else {
        $em = "Error occured";
        header("Location: ../admin/section.php?error=$em");
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