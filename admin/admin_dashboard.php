<?php 
session_start();
include ("../action/admin_session.php");
include ("../config/dbConn.php");
include ("../action/admin_login_handler.php");

//team details 3rd
$sql_3rd_teams = "SELECT * FROM proposals WHERE year = '3rd' AND assigned_supervisor <> '' ";
$result_3rd_teams = mysqli_query($conn, $sql_3rd_teams);

//team details 4th
$sql_4th_teams = "SELECT * FROM proposals WHERE year = '4th' AND assigned_supervisor <> '' ";
$result_4th_teams = mysqli_query($conn, $sql_4th_teams);

//supervisor details
$sql_all_supervisor = "SELECT * FROM supervisor";
$result_all_supervisor = mysqli_query($conn,$sql_all_supervisor);
$all_supervisor = mysqli_fetch_all($result_all_supervisor, MYSQLI_ASSOC);
$total_supervisor = mysqli_num_rows($result_all_supervisor);

$assigned = 0;
$count =0;
foreach ($all_supervisor as $supervisor):
    $sql_assigned = "SELECT * FROM proposals
    WHERE assigned_supervisor = '{$supervisor['initial']}' ";
    $result_assigned = mysqli_query($conn, $sql_assigned);
    $count = mysqli_num_rows($result_assigned);
endforeach;
$assigned = $assigned + $count;
$not_assigned = $total_supervisor-$assigned;

//completed project details 
$sql_completed = "SELECT * FROM completed_projects WHERE status = 'completed' ";
$result_completed = mysqli_query($conn, $sql_completed);
$completed = mysqli_num_rows($result_completed);


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
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="admin_logout.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->


<main>
    <!--supervisor landpage / dashboard section-->
    <div class="bg-gradient">
        <div class="h3 text-light ms-5 ps-5">Admin</div>
    </div>
    <hr class="text-light">
    <!--page content-->
    <div class="container ">
        <div class="row mb-5 pb-5">
            
            <!--sidebar start-->
            <?php include ("admin_sidebar.php"); ?>
            <!--sidebar end-->
            
            <!--admin dashboard section-->
            <div class="col-sm-11 col-md-8 col-lg-8 ">

                <div class="">
                    <div class="text-light text-center h4">Dashboard</div>
                    <hr class="text-light">
                </div>
                <!--details-->
                <div class="row">

                    <!--team info-->
                    <div class="col-6 border-end">

                        <div class="bg-secondary p-1">
                            <div class="text-light text-center h6 mt-3">Teams</div>
                        </div>
                        

                        <form class=" " name=""  action="" method="">
                            <table class="table table-bordered rounded table-secondary">
                                <tr>
                                    <td class="h6">3rd Year</td>
                                    <td class="fs-6 fw-bold">
                                        <?php echo $teams_3rd = mysqli_num_rows($result_3rd_teams) ?>
                                    </td>
                                    <td class=""><a class="btn btn-sm text-primary" href="3rd_year_teams.php">see more</a></td>
                                </tr>
                                <tr >
                                    <td class="h6">4th Year</td>
                                    <td class="fs-6 fw-bold">
                                        <?php echo $teams_4th = mysqli_num_rows($result_4th_teams) ?>
                                    </td>
                                    <td class=""><a class="btn btn-sm text-primary" href="4th_year_teams.php">see more</a></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    

                    <!--Supervisor info-->
                    <div class="col-6">

                        <div class="bg-secondary p-1">
                            <div class="text-light text-center h6 mt-3">Supervisors</div>
                        </div>
                        

                        <form class=" " name=""  action="" method="">
                            <table class="table table-bordered rounded table-secondary">
                                <tr>
                                    <td class="h6">Assigned to Team  </td>
                                    <td class="fs-6 fw-bold"><?php echo $assigned ?></td>
                                    <td class=""><a class="btn btn-sm text-primary" href="">see more</a></td>
                                </tr>
                                <tr >
                                    <td class="h6">Not Assigned  </td>
                                    <td class="fs-6 fw-bold"><?php echo $not_assigned ?></td>
                                    <td class=""><a class="btn btn-sm text-primary" href="">see more</a></td>
                                </tr>
                                
                            </table>
                        </form>
                    </div>
                </div>
                <!--details end-->


                <!--All projects detail-->
                <div class="mt-4">
                <div class="bg-secondary p-1">
                    <div class="text-light text-center h6 mt-3">Projects</div>
                </div>
                <table class="table table-bordered rounded table-secondary text-center">
                    <tr>
                        <th colspan="2">Completed</th>
                        <th colspan="2">In progress</th>
                    </tr>
                    <tr  class="h6">
                        <td rowspan="2" colspan="2"  class="fs-5 pt-4"><?php echo $completed ?></td>
                        <td class="">3rd Year</td>
                        <td class="">4th Year</td>
                    </tr>
                    <tr >
                        <td class=""><?php echo $teams_3rd ?></td>
                        <td class=""><?php echo $teams_4th ?></td>
                    </tr>
                    
                </table>
                </div>


                 

                
                
            </div>

            
        </div>
        
        
        </div>
        

    </div>
</main>


        

<script src="scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<?php include("../inc/foot.php"); ?>
</body>

</html>