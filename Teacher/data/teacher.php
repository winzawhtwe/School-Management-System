<?php

//Get Teachers by ID
function getTeacherByID($teacher_id, $conn){
    $sql = "SELECT * FROM teacher
            WHERE teacher_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$teacher_id]);

    if ($stmt->rowCount() == 1) {
        $teacher = $stmt->fetch();
        return $teacher;
    }else {
        return 0;
    }
}

?>