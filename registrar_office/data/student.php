<?php

//All Students 
function getAllStudents($conn){
    $sql = "SELECT * FROM student";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $student = $stmt->fetchAll();
        return $student;
    }else {
        return 0;
    }
}

// DELETE
// function removeStudent($id, $conn){
//     $sql = "DELETE FROM student
//             WHERE student_id=?";
//     $stmt = $conn->prepare($sql);
//     $re   = $stmt->execute([$id]);
//     if ($re) {
//         return 1;
//     }else {
//         return 0;
//     }
// }

//Get Students by ID
function getStudentByID($id, $conn){
    $sql = "SELECT * FROM student
            WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() == 1) {
        $student = $stmt->fetch();
        return $student;
    }else {
        return 0;
    }
}

//Check if the username Unique
function unameIsUnique($uname, $conn, $student_id=0){
    $sql = "SELECT username, student_id FROM student
            WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);

    if ($student_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
        }
    }else {
        if ($stmt->rowCount() >= 1) {
            $student = $stmt->fetch();
            if ($student['student_id'] == $student_id) {
                return 1;
            }else return 0;
        }else {
            return 1;
        }
    }
    
}

// Search
function searchStudents($key, $conn){
    $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$key);
    $sql = "SELECT * FROM student
            WHERE student_id LIKE ?
            OR fname LIKE ?
            OR lname LIKE ?
            OR username LIKE ?
            OR grade LIKE ?
            OR section LIKE ?
            OR address LIKE ?
            OR gender LIKE ?
            OR email_address LIKE ?
            OR date_of_birth LIKE ?
            OR date_of_joined LIKE ?
            OR parent_fname LIKE ?
            OR parent_lname LIKE ?
            OR parent_phone_number LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key, $key, $key, $key, $key, $key, $key]);

    if ($stmt->rowCount() == 1) {
        $student = $stmt->fetchAll();
        return $student;
    }else {
        return 0;
    }
}