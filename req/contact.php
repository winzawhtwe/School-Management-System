<?php 
if (isset($_POST['email']) &&
isset($_POST['full_name']) && 
isset($_POST['message'])) {

    include "../DB_connection.php";

        $email     = $_POST['email'];
        $full_name = $_POST['full_name'];
        $message   = $_POST['message'];

        if (empty($email)) {
            $em = "Email address is required";
            header("Location: ../index.php?error=$em#contact");
            exit;
        }elseif (empty($full_name)) {
            $em = "Full Name is required";
            header("Location: ../index.php?error=$em#contact");
            exit;
        }elseif (empty($message)) {
            $em = "Message is required";
            header("Location: ../index.php?error=$em#contact");
            exit;
        }else {
            $sql = "INSERT INTO
                message(sender_full_name, sender_email, message)
                VALUES(?,?,?)"; 

        $stmt = $conn->prepare($sql);
        $stmt->execute([$full_name, $email, $message]);
        $sm = "Message sent successfully!";
        header("Location: ../index.php?success=$sm#contact");
        exit;
    }
}else {
    header("Location: ../login.php");
    exit;
}

?>