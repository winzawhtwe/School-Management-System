<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Teacher') {
        include "../DB_connection.php";
        include "data/teacher.php";
        include "data/subject.php";
        include "data/section.php";
        include "data/class.php";
        include "data/grade.php";

        $teacher_id = $_SESSION['teacher_id'];
        $teacher = getTeacherByID($teacher_id, $conn);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content="width=device-width,
        initial-scale=1.0">
        <title>Teacher - Home</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../style.css">
        <link rel="icon" href="../logo.png.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php
            include "inc/navbar.php";
        ?>
        <?php
            if ($teacher != 0) { 
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column container mt-5">
            <div class="card" style="width: 25rem;">
            <img src="../img/teacher-<?=$teacher['gender']?>.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center"><?=$teacher['username']?></h5>
                <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">First Name : <?=$teacher['fname']?></li>
                <li class="list-group-item">Last Name : <?=$teacher['lname']?></li>
                <li class="list-group-item">User Name : <?=$teacher['username']?></li>

                <li class="list-group-item">Address : <?=$teacher['address']?></li>
                <li class="list-group-item">Employee Number : <?=$teacher['employee_number']?></li>
                <li class="list-group-item">Date of Birth : <?=$teacher['date_of_birth']?></li>
                <li class="list-group-item">Phone Number : <?=$teacher['phone_number']?></li>
                <li class="list-group-item">Qualification : <?=$teacher['qualification']?></li>
                <li class="list-group-item">Gender : <?=$teacher['gender']?></li>
                <li class="list-group-item">Email-Address : <?=$teacher['email_address']?></li>
                <li class="list-group-item">Date of joined : <?=$teacher['date_of_joined']?></li>

                
                <li class="list-group-item">Subject : 
                    <?php 
                        $s = '';
                         $subject = str_split(trim($teacher['subject']));
                         foreach ($subject as $subject) {
                         $s_temp = getSubjectByID($subject, $conn);
                                    if ($s_temp != 0) 
                                    $s =$s_temp['subject_code'];
                            }
                         echo $s;
                    ?>
                </li>

                <li class="list-group-item">Class : 
                    <?php 
                            $c = '';
                            $class = str_split(trim($teacher['class']));
                            foreach ($class as $class) {
                            $class = getClassById($class, $conn);
                            $c_temp = getGradeById($class['grade'], $conn);
                            $section = getSectionById($class['section'], $conn);
                            if ($c_temp != 0) 
                                $c =$c_temp['grade_code'].' - '. $c_temp['grade'].','.' '.$section['section'];
                            }
                            echo $c;
                        ?>
                    </li>
                </ul>
            </div>
        </div><br />
        <?php
            }else {
                header("Location: teacher.php");
            exit;
            }
        ?>
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js></script>
    </body>
</html>
<?php 

    }else {
        header("Location: ../login.php");
        exit;
    } 

}else {
        header("Location: ../login.php");
        exit;
} 

?>