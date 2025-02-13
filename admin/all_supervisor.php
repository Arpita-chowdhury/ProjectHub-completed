<?php 
session_start();
include ("../config/dbConn.php");
include ("../action/admin_login_handler.php");

$sql_all_supervisor = "SELECT * FROM supervisor";
$result_all_supervisor = mysqli_query($conn,$sql_all_supervisor);
$all_supervisor = mysqli_fetch_all($result_all_supervisor, MYSQLI_ASSOC);
$count =0;

//remove supervisor
if(isset($_POST["remove"])){
    $remove_supervisor = $_POST["remove"];
    echo "<script>
        var result = confirm('Really want to remove supervisor?');
            if (result == true) {
                window.location.href = 'remove_supervisor.php?supervisor=$remove_supervisor';
            } else {
                window.location.href='all_supervisor.php';
            }
        </script>";
    
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include("../inc/head.php"); ?>
<body class="bg-dark">
<!--The mother container div start-->
<div class="container">
    <!--navbar starts here-->
    <header>
        <nav class="navbar navbar-expand-sm bg-secondary px-2">
            <a class="navbar-brand d-flex text-capitalize" href="../index.php" >
                <?php include("../inc/logo.php"); ?>
            </a><?php include("../inc/nav_collapse.php"); ?>
            <!--navbar links-->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../action/logout.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->


<main>
    <!--supervisor landpage / dashboard section-->
    <div class="">
        <div class="h3 text-light mt-3 ms-5 ps-5">Admin</div>
    </div>
    <hr class="text-light">
    <!--page content-->
    <div class="container ">
        <div class="row mb-5 pb-5">
            
            <!--sidebar start-->
            <?php include ("admin_sidebar.php"); ?>
            <!--sidebar end-->
            
            
            <div class="col-sm-11 col-md-8 col-lg-8 ">
                <!--details-->
                <!--team info-->
                    <div class="col">

                        <div class="bg-secondary p-1">
                            <div class="text-light text-center h5 mt-3">Supervisors</div>
                        </div>
                        <form class=" " name=""  action="" method="">
                            <table class="table table-bordered rounded table-secondary text-center">
                                <tr>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Supervising Teams</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($all_supervisor as $supervisor):
                                            $sql_assigned = "SELECT * FROM proposals
                                            WHERE assigned_supervisor = '{$supervisor['initial']}' ";
                                            $result_assigned = mysqli_query($conn, $sql_assigned);
                                            $count = mysqli_num_rows($result_assigned);
                                    ?>
                                    <tr>
                                    <td><?php echo $supervisor['name'] ?></td>
                                    <td><?php echo $supervisor['designation'] ?></td>
                                    <td><?php echo $count ?></td>
                                    <form action="" method="post">
                                    <td>
                                        <button class="btn btn-sm text-danger" name="remove" value="<?php echo $supervisor['initial'] ?>" >Remove</button>
                                    </td>
                                    </form>
                                </tr>
                                    
                                <?php endforeach; ?>
                               
                                
                                
                            </table>
                        </form>
                    </div>
                </div>
                <!--details end-->
    
            </div>

            
        </div>
        
        
        </div>
        

    </div>
</main>


        

<script src="scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<?php include("../action/form_resubmission_handler.php"); ?>
<?php include("../inc/foot.php"); ?>
</body>

</html>