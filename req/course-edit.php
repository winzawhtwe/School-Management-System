<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['course_name'])  &&
    isset($_POST['course_code'])  &&
    isset($_POST['course_id'])    &&
    isset($_POST['grade']))    {

    include '../DB_connection.php';

    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $course_id = $_POST['course_id'];
    $grade = $_POST['grade'];

    $data = 'course_id='.$course_id;

    if (empty($course_id)) {
        $em = "Course ID is required";
        header("Location: ../admin/course-edit.php?error=$em&$data");
        exit;
    }else if (empty($course_name)) {
        $em = "Course Name is required";
        header("Location: ../admin/course-edit.php?error=$em&$data");
        exit;
    }else if (empty($course_code)) {
        $em = "Course Code is required";
        header("Location: ../admin/course-edit.php?error=$em&$data");
        exit;
    }else if (empty($grade)) {
        $em = "Grade is required";
        header("Location: ../admin/course-edit.php?error=$em&$data");
        exit;
    }else {
        // check if the class already exists
        $sql_check = "SELECT * FROM subject
                      WHERE grade=? AND subject_code=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$grade, $course_code]);
        if ($stmt_check->rowCount() > 0) {
            $course = $stmt_check->fetch();
            if ($course['subject_id'] == $course_id) {
                $sql = "UPDATE subject SET
                grade = ?, subject=?, subject_code=?
                WHERE subject_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$grade, $course_name, $course_code, $course_id]);
            $sm = "Course Successfully updated!";
        header("Location: ../admin/course-edit.php?success=$sm&$data");
        exit;
            }else {
                $em = "The course is already exists!";
                header("Location: ../admin/course-edit.php?error=$em&$data");
                exit;
            }
        }else {
        $sql = "UPDATE subject SET
                grade = ?, subject=?, subject_code=?
                WHERE subject_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$grade, $course_name, $course_code, $course_id]);
        $sm = "Course Successfully updated!";
        header("Location: ../admin/course-edit.php?success=$sm&$data");
        exit;
        }
    }

    }else {
        $em = "Error occured";
        header("Location: ../admin/course.php?error=$em");
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