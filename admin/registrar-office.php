<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/registrar-office.php";
        // include "data/subject.php";
        // include "data/grade.php";
        // include "data/class.php";
        // include "data/section.php";
        $registrar_office = getAllR_users($conn);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content="width=device-width,
        initial-scale=1.0">
        <title>Admin - Registrar Office</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../style.css">
        <link rel="icon" href="../logo.png.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php
            include "inc/navbar.php";
            if ($registrar_office != 0) { 
        ?>
        <div class="container mt-5">
            <a href="registrar-office-add.php"
                class="btn btn-dark">Add New User</a>

                <!-- <form action="registrar_office-search.php" 
                      class="mt-3  n-table"
                      method="get">
                <div class="input-group mb-3">
                    <input type="text" 
                           class="form-control"
                           name="searchKey"
                           placeholder="search...">
                    <button class="btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </form> -->

                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger mt-3 n-table" 
                         role="alert">
                        <?=$_GET['error']?>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-info mt-3 n-table" 
                         role="alert">
                        <?=$_GET['success']?>
                    </div>
                <?php } ?>

                <div class="table-responsive">
                <table class="table table-bordered mt-3 n-table">
                    <thead>
                        <tr>
                        <th scope="col">№</th>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($registrar_office as $registrar_office ) { 
                            $i++; ?>
                        <tr>
                        <th scope="row"><?=$i?></th>
                        <td><?=$registrar_office['r_user_id']?></td>
                        <td><a href="registrar-office-view.php?r_user_id=<?=$registrar_office['r_user_id']?>">
                            <?=$registrar_office['fname']?></a></td>
                        <td><?=$registrar_office['lname']?></td>
                        <td><?=$registrar_office['username']?></td>
                        <td>
                            <a href="registrar-office-edit.php?r_user_id=<?=$registrar_office['r_user_id']?>"
                                class="btn btn-warning">Edit</a> 
                            <a href="registrar-office-delete.php?r_user_id=<?=$registrar_office['r_user_id']?>"
                                class="btn btn-danger">Delete</a>
                        </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            <?php }else{ ?>
                <div class="alert alert-info .w-450 m-5" 
                     role="alert">
                    Empty!
                </div>
            <?php } ?>
        </div>
        
        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js></script>
        <script
            $(document).ready(function(){
                $("#navLinks li:nth-child(2) a").addClass('active');
            }); >
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