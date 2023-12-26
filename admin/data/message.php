<?php 

//All Messages 
function getAllMessages($conn){
    $sql = "SELECT * FROM message ORDER BY message_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $messages = $stmt->fetchAll();
        return $messages;
    }else {
        return 0;
    }
}

// DELETE
function removeMessage($id, $conn){
    $sql = "DELETE FROM message
            WHERE message_id=?";
    $stmt = $conn->prepare($sql);
    $re   = $stmt->execute([$id]);
    if ($re) {
        return 1;
    }else {
        return 0;
    }
}

?>