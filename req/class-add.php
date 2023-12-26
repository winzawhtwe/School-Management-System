<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['grade']) &&
    isset($_POST['section']))  {

    include '../DB_connection.php';
    
    $grade = $_POST['grade'];
    $section = $_POST['section'];

    if (empty($grade)) {
        $em = "Grade is required";
        header("Location: ../admin/class-add.php?error=$em");
        exit;
    }else if (empty($section)) {
        $em = "Section is required";
        header("Location: ../admin/class-add.php?error=$em");
        exit;
    }else {
        // check if the class already exists
        $sql_check = "SELECT * FROM class
                      WHERE grade=? AND section=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$grade, $section]);
        if ($stmt_check->rowCount() > 0) {
            $em = "The class already exists!";
            header("Location: ../admin/class-add.php?error=$em");
            exit;
        }else {
            $sql = "INSERT INTO
                class(grade, section)
                VALUES(?,?)"; 
            $stmt = $conn->prepare($sql);
            $stmt->execute([$grade, $section]);
            $sm = "New class added successfully!";
            header("Location: ../admin/class-add.php?success=$sm");
        exit;
        }

        
    }

    }else {
        $em = "Error occured";
        header("Location: ../admin/class-add.php?error=$em");
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