<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/class.php";
        include "data/grade.php";
        include "data/section.php";
        
        $class = getAllClasses($conn);
        $grade = getAllGrades($conn);
        $section = getAllSections($conn);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content="width=device-width,
        initial-scale=1.0">
        <title>Admin - Add Class</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../style.css">
        <link rel="icon" href="../logo.png.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php
            include "inc/navbar.php";
            if ($section == 0 || $grade == 0) { ?>
            
            <div class="alert alert-info" role="alert">
            First create section and class
            </div>
            <a href="class.php"
                class="btn btn-dark">Go Back</a>
            <?php } ?>
        ?>
        <div class="container mt-5">
            <a href="class.php"
                class="btn btn-dark">Go Back</a>

                <form method="post"
                      class="shadow p-3 mt-5 form-w"
                      action="../req/class-add.php">
                <h3>Add New Class</h3><hr>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?=$_GET['error']?>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?=$_GET['success']?>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label class="form-label">Grade</label>
                    <select name="grade"
                            class="form-control">
                            <?php foreach ($grade as $grade) { ?>
                                <option value="<?=$grade['grade_id']?>">
                                    <?=$grade['grade_code'].'-'.$grade['grade']?>
                                </option>
                            <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Section</label>
                    <select name="section"
                            class="form-control">
                            <?php foreach ($section as $section) { ?>
                                <option value="<?=$section['section_id']?>">
                                    <?=$section['section']?>
                                </option>
                            <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create new class</button>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js></script>
        <script
            $(document).ready(function(){ 
                $("#navLinks li:nth-child(3) a").addClass('active');
            });>
        </script>
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