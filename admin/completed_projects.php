<?php 
session_start();
include ("../config/dbConn.php");
include ("../action/admin_login_handler.php");

$sql_projects = "SELECT * FROM completed_projects";
$result_projects = mysqli_query($conn,$sql_projects);

//remove a project
if(isset($_POST["remove"])){
    $remove_project = $_POST["remove"];
    echo "<script>
        var result = confirm('Really want to remove this project?');
            if (result == true) {
                window.location.href = 'remove_project.php?project=$remove_project';
            } else {
                window.location.href='completed_projects.php';
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
    <hr class="text-light mb-0">
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
                        <!--tabs-->
                        <div class="bg-dark bg-gradient">
                            <ul class="nav nav-tabs justify-content-end">
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="all_projects.php">In-progress</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light bg-dark active " href="completed_projects.php">Completed</a>
                                </li>
                            </ul>
                        </div>
                        <div class="bg-secondary p-1">
                            <div class="text-light text-center h5 mt-3">Projects</div>
                        </div>
                        <form class=" " name=""  action="" method="">
                            <table class="table table-bordered rounded table-secondary text-center">
                                <tr>
                                    <th>Project Title</th>
                                    <th>Descipline</th>
                                    <th>Details</th>
                                    <th>Supervisor</th>
                                    <th>Action</th>
                                </tr>
                                <?php while($row = mysqli_fetch_assoc($result_projects)){ ?>
                                    <tr>
                                    <td class=""><?php echo $row["project_title"]; ?></td>
                                    <td class=""><?php echo $row["descipline"]; ?></td>
                                    <td><?php echo $row["description"]; ?></td>
                                    <td><?php echo $row["supervisor"]; ?></td>
                                    <form action="" method="post">
                                    <td><button class="btn btn-sm text-danger" name="remove" value="<?php echo $row["team_id"]; ?>" >remove</button></td>
                                    </form>
                                    </tr>
                                <?php } ?> 
                                
                                
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