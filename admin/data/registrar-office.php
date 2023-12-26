<?php

//Get r_user by ID
function getR_usersByID($r_user_id, $conn){
    $sql = "SELECT * FROM registrar_office
            WHERE r_user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$r_user_id]);

    if ($stmt->rowCount() == 1) {
        $registrar_office = $stmt->fetch();
        return $registrar_office;
    }else {
        return 0;
    }
}

//All r_user 
function getAllR_users($conn){
    $sql = "SELECT * FROM registrar_office";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $registrar_office = $stmt->fetchAll();
        return $registrar_office;
    }else {
        return 0;
    }
}

//Check if the username Unique
function unameIsUnique($uname, $conn, $r_user_id=0){
    $sql = "SELECT username, r_user_id FROM registrar_office
            WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);

    if ($r_user_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
        }
    }else {
        if ($stmt->rowCount() == 1) {
            $registrar_office = $stmt->fetch();
            if ($registrar_office['r_user_id'] == $r_user_id) {
                return 1;
            }else return 0;
        }else {
            return 1;
        }
    }
    
}

// DELETE
function removeR_user($id, $conn){
    $sql = "DELETE FROM registrar_office
            WHERE r_user_id=?";
    $stmt = $conn->prepare($sql);
    $re   = $stmt->execute([$id]);
    if ($re) {
        return 1;
    }else {
        return 0;
    }
}

// Search
// function searchTeacher($key, $conn){
//     $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$key);

//     $sql = "SELECT * FROM teacher
//             WHERE teacher_id LIKE ?
//             OR fname LIKE ?
//             OR lname LIKE ?
//             OR username LIKE ?
//             OR address LIKE ?
//             OR employee_number LIKE ?
//             OR date_of_birth LIKE ?
//             OR phone_number LIKE ?
//             OR qualification LIKE ?
//             OR gender LIKE ?
//             OR email_address LIKE ?
//             OR date_of_joined LIKE ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key, $key, $key, $key, $key]);

//     if ($stmt->rowCount() == 1) {
//         $teacher = $stmt->fetchAll();
//         return $teacher;
//     }else {
//         return 0;
//     }
// }
