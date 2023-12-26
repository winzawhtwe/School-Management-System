<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/student.php";
        include "data/section.php";
        
        include "data/grade.php";

        if(isset($_GET['student_id'])){
        $student_id = $_GET['student_id'];

        $student = getStudentByID($student_id, $conn);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content="width=device-width,
        initial-scale=1.0">
        <title>Admin - Student</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../style.css">
        <link rel="icon" href="../logo.png.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php
            include "inc/navbar.php";
            if ($student != 0) { 
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column container mt-5">
            <div class="card" style="width: 25rem;">
            <img src="../img/student-<?=$student['gender']?>.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center"><?=$student['username']?></h5>
                <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">First Name : <?=$student['fname']?></li>
                <li class="list-group-item">Last Name : <?=$student['lname']?></li>
                <li class="list-group-item">User Name : <?=$student['username']?></li>
                <li class="list-group-item">Gender : <?=$student['gender']?></li>

                <li class="list-group-item">Address : <?=$student['address']?></li>
                <li class="list-group-item">Email-Address : <?=$student['email_address']?></li>
                <li class="list-group-item">Date of Birth : <?=$student['date_of_birth']?></li>
                <li class="list-group-item">Date of joined : <?=$student['date_of_joined']?></li>


                <li class="list-group-item">Grade : 
                    <?php 
                        $g = '';
                         $grade = str_split(trim($student['grade']));
                         foreach ($grade as $grade) {
                         $g_temp = getGradeById($grade, $conn);
                                    if ($g_temp != 0) 
                                    $g =$g_temp['grade_code'].' - '. $g_temp['grade'];
                            }
                         echo $g;
                    ?>
                </li>

                <li class="list-group-item">Section : 
                    <?php 
                        $s = '';
                         $section = str_split(trim($student['section']));
                         foreach ($section as $section) {
                         $s_temp = getSectionById($section, $conn);
                                    if ($s_temp != 0) 
                                    $s = $s_temp['section'];
                            }
                         echo $s;
                    ?>
                </li><br>
                
                <li class="list-group-item">Parent first name : <?=$student['parent_fname']?></li>
                <li class="list-group-item">Parent last name : <?=$student['parent_lname']?></li>
                <li class="list-group-item">Parent phone number : <?=$student['gender']?></li>

            </ul>
            <div class="card-body">
                <a href="student.php" class="card-link">Go Back</a>
            </div>
            </div>
        </div>
        <?php
            }else {
                header("Location: student.php");
            exit;
            }
        ?>

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js></script>
       
    </body>
</html>
<?php 

        }else {
            header("Location: student.php");
        exit;
        }

    }else {
        header("Location: ../login.php");
        exit;
    } 

}else {
        header("Location: ../login.php");
        exit;
} 

?>