<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['section']) &&
    isset($_POST['grade'])      &&
    isset($_POST['class_id']))    {

    include '../DB_connection.php';
    include '../admin/data/grade.php';
    include '../admin/data/section.php';
    include '../admin/data/class.php';

    $section = $_POST['section'];
    $grade = $_POST['grade'];
    $class_id = $_POST['class_id'];

    $data = 'class_id='.$class_id;

    if (empty($grade)) {
        $em = "Grade is required";
        header("Location: ../admin/class-edit.php?error=$em&$data");
        exit;
    }else if (empty($section)) {
        $em = "Section is required";
        header("Location: ../admin/class-edit.php?error=$em&$data");
        exit;
    }else if (empty($class_id)) {
        $em = "Class Id is required";
        header("Location: ../admin/class-edit.php?error=$em&$data");
        exit;
    }else {
        // check if the class already exists
        $sql_check = "SELECT * FROM class
                      WHERE grade=? AND section=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$grade, $section]);
        if ($stmt_check->rowCount() > 0) {
            $em = "The class already exists!";
            header("Location: ../admin/class-edit.php?error=$em&$data");
            exit;
        }else {
        $sql = "UPDATE class SET
                grade = ?, section=?
                WHERE class_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$grade, $section, $class_id]);
        $sm = "Successfully updated!";
        header("Location: ../admin/class-edit.php?success=$sm&$data");
        exit;
    }
}

    }else {
        $em = "Error occured";
        header("Location: ../admin/class.php?error=$em");
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