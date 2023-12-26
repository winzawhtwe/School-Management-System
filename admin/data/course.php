<?php

// DELETE course
function removeCourse($id, $conn){
    $sql  = "DELETE FROM course
            WHERE course_id=?";
    $stmt = $conn->prepare($sql);
    $re   = $stmt->execute([$id]);
    if ($re) {
      return 1;
    }else {
     return 0;
    }
 }

 ?>