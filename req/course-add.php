<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['grade']) &&
    isset($_POST['course_name']) &&
    isset($_POST['course_code']))  {

    include '../DB_connection.php';
    
    $grade = $_POST['grade'];
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];

    if (empty($course_name)) {
        $em = "Course Name is required";
        header("Location: ../admin/course-add.php?error=$em");
        exit;
    }else if (empty($course_code)) {
        $em = "Course Code is required";
        header("Location: ../admin/course-add.php?error=$em");
        exit;
    }else if (empty($grade)) {
        $em = "Grade is required";
        header("Location: ../admin/course-add.php?error=$em");
        exit;
    }else {
        // check if the class already exists
        $sql_check = "SELECT * FROM subject
                      WHERE grade=? AND subject_code=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$grade, $course_code]);
        if ($stmt_check->rowCount() > 0) {
            $em = "This course is already exists!";
            header("Location: ../admin/course-add.php?error=$em");
            exit;
        }else {
            $sql = "INSERT INTO
                subject(grade, subject, subject_code)
                VALUES(?,?,?)"; 
            $stmt = $conn->prepare($sql);
            $stmt->execute([$grade, $course_name, $course_code]);
            $sm = "New course added successfully!";
            header("Location: ../admin/course-add.php?success=$sm");
        exit;
        }

        
    }

    }else {
        $em = "Error occured";
        header("Location: ../admin/course-add.php?error=$em");
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