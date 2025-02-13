<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

//teams 3rd year
$sql_teams1 = "SELECT * FROM proposals
WHERE assigned_supervisor = '$supervisor' AND year = '3rd' ";
$result_teams1 = mysqli_query($conn, $sql_teams1);
$teams1 = mysqli_fetch_all($result_teams1, MYSQLI_ASSOC);
$teams_3rd = mysqli_num_rows($result_teams1);

//tasks 3rd year
$tasks_3rd = 0;
$count1 = 0;
foreach ($teams1 as $team):
    $sql_tasks1 = "SELECT * FROM tasks
    WHERE supervisor = '$supervisor' AND progress = 'Not Started' OR progress = 'In-progress' AND team_id = '$team[team_id]' ";
    $result_tasks1 = mysqli_query($conn, $sql_tasks1);
    $count1 = mysqli_num_rows($result_tasks1);   
endforeach;
$tasks_3rd = $tasks_3rd + $count1;

//teams 4th year
$sql_teams2 = "SELECT * FROM proposals
WHERE assigned_supervisor = '$supervisor' AND year = '4th' ";
$result_teams2 = mysqli_query($conn, $sql_teams2);
$teams2 = mysqli_fetch_all($result_teams2, MYSQLI_ASSOC);
$teams_4th = mysqli_num_rows($result_teams2);

//tasks 4th year
$tasks_4th = 0;
$count2 = 0;
foreach ($teams2 as $team):
    $sql_tasks2 = "SELECT * FROM tasks
    WHERE supervisor = '$supervisor' AND progress = 'Not Started' OR progress = 'In-progress' AND team_id = '$team[team_id]'";
    $result_tasks2 = mysqli_query($conn, $sql_tasks2);
    $count2 = mysqli_num_rows($result_tasks2);    
endforeach;
$tasks_4th = $tasks_4th + $count2;
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
                    <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Reset Password"><a class="nav-link text-light" href="reset/reset_password1.php"><i class="fa-solid fa-gear"></i></a></li>
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../action/logout.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->


<main>
    <!--supervisor landpage / dashboard section-->
    <div class="">
        <div class="bg-dark bg-gradient text-light py-3">
            <span class="ms-5 me-3 h5 ">
            <i class="fa-solid fa-user-tie me-3"></i><?php echo $supervisor_name ?></span>
            <span class="" style="" >(<?php echo $supervisor_designation ?>)</span>
        </div>
    </div>
    <hr class="text-light mt-0 mb-2">

    <!--page content-->
    <div class="container pb-4">
        <div class="row mb-5">
            
            <!--sidebar start-->
            <?php include ("../inc/sidebar_supervisor.php"); ?>
            <!--sidebar end-->
            


            <!--supervisor dashboard section-->
            <div class="col-sm-11 col-md-8 col-lg-8 mb-5">

                <div class="bg-secondary py-1">
                    <div class="text-light text-center h4 ">Dashboard</div>
                </div>
                <hr class="text-light">

                <!--Year wise details-->
                <div class="row">

                    <!--3rd year info-->
                    <div class="col-6 border-end">

                        <div class="bg-secondary p-1">
                            <div class="text-light text-center h6 mt-3">3rd Year</div>
                        </div>
                        

                        <form class=" " name=""  action="" method="">
                            <table class="table table-bordered rounded table-secondary">
                                <tr>
                                    <td class="h6">Supervising Teams  </td>
                                    <td class="fs-6 fw-bold">
                                        <?php echo $teams_3rd = mysqli_num_rows($result_teams1) ?>
                                    </td>
                                </tr>
                                <tr >
                                    <td class="h6">Task Assigned  </td>
                                    <td class="fs-6 fw-bold">
                                    <?php echo $tasks_3rd ?>
                                    
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    

                    <!--4th year info-->
                    <div class="col-6">

                        <div class="bg-secondary p-1">
                            <div class="text-light text-center h6 mt-3">4th Year</div>
                        </div>
                        

                        <form class=" " name=""  action="" method="">
                            <table class="table table-bordered rounded table-secondary">
                                <tr>
                                    <td class="h6">Supervising Teams  </td>
                                    <td class="fs-6 fw-bold">
                                    <?php echo $teams_4th = mysqli_num_rows($result_teams2) ?>
                                    </td>
                                </tr>
                                <tr >
                                    <td class="h6">Task Assigned  </td>
                                    <td class="fs-6 fw-bold">
                                    <?php echo $tasks_4th ?>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <!--Year wise details end-->


                 

                
                
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