<?php

//All Subjects
function getAllSubjects($conn){
    $sql = "SELECT * FROM subject";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $subject = $stmt->fetchAll();
        return $subject;
    }else {
        return 0;
    }
}

//Get Subjects by ID
function getSubjectByID($subject_id, $conn){
    $sql = "SELECT * FROM subject
            WHERE subject_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$subject_id]);

    if ($stmt->rowCount() == 1) {
        $subject = $stmt->fetch();
        return $subject;
    }else {
        return 0;
    }
}

// DELETE course
function removeCourse($id, $conn){
    $sql  = "DELETE FROM subject
            WHERE subject_id=?";
    $stmt = $conn->prepare($sql);
    $re   = $stmt->execute([$id]);
    if ($re) {
      return 1;
    }else {
     return 0;
    }
 }

?>