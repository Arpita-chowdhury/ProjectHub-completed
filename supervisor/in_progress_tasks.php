<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

//for showing assigned task
$sql_team_tasks = "SELECT * FROM tasks where supervisor = '$supervisor' AND progress = 'In-progress' ";
$result_team_tasks = mysqli_query($conn, $sql_team_tasks);

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
    <!--assigned tasks section-->
    <div class="">
        <div class="bg-dark bg-gradient text-light py-3">
            <span class="ms-5 me-3 h5 ">
            <i class="fa-solid fa-user-tie me-3"></i><?php echo $supervisor_name ?></span>
            <span class="" style="" >(<?php echo $supervisor_designation ?>)</span>
        </div>
    </div>
    <hr class="text-light mt-0 mb-2">

    

    <!--page content-->
    <div class="container ">
        <div class="row mb-5 pb-5">
            
            <!--sidebar start-->
            <?php include ("../inc/sidebar_supervisor.php"); ?>
            <!--sidebar end-->


            <!--already assigned tasks to each teams-->
            <div class="col-sm-11 col-md-8 col-lg-8 mb-4">
                <!--tabs-->
                <div class="bg-dark bg-gradient">
                    <ul class="nav nav-tabs justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="assigned_tasks.php">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="not_started_tasks.php">Not Started</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light bg-dark active" href="in_progress_tasks.php">In-progress</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light " href="completed_tasks.php">Completed</a>
                        </li>
                    </ul>
                </div>

                <div class="bg-secondary py-1">
                    <div class="text-light text-center h5 ">Tasks Assigned to Supervising teams</div>
                    <hr class="text-light mt-0 mb-1">
                </div>
                <form class="" name=""  action="" method="">
                    <table class="table table-striped text-center">
                        <tr>
                            <th>Team Members</th>
                            <th>Project Title</th>
                            <th>Task</th>
                            <th>Progress</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>

                        <?php while($team_task = mysqli_fetch_assoc($result_team_tasks)){ ?>
                            <tr  rowspan="4">
                            <td>
                                <ol>
                                    <?php
                                    $sql_team_member = "SELECT * FROM user WHERE team_id = {$team_task['team_id']} ";
                                    $result_team_member = mysqli_query($conn,$sql_team_member );
                                    while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                        <li><?php echo $team_member["name"] ?></li>
                                    <?php } ?>
                                </ol>
                                <div><a class="btn btn-transparent btn-sm text-primary" href="team_details.php?team_id=<?php echo $team_task["team_id"]; ?>">Details</a></div>
                            </td>
                            <td><?php echo $team_task["project_title"] ?></td>
                            <td><?php echo $team_task["task"] ?></td>
                            
                            <?php
                                if($team_task["progress"]=="In-progress"){
                                    $color = "text-primary";
                                }elseif($team_task["progress"]=="Completed"){
                                    $color = "h6 text-success";
                                }else{
                                    $color = "text-dark";
                                }
                            ?>
                            <td class="<?php echo $color ?>">
                                <?php echo $team_task["progress"] ?>
                            </td>
                            
                            <?php
                            //show due tasks where deadline is over
                                date_default_timezone_set('Asia/Dhaka');
                                $current_date = date("Y-m-d");
                                $deadline = date("Y-m-d", strtotime($team_task["deadline"]));
                                if($team_task["progress"] !== "Completed" && $deadline < $current_date){ ?>
                                    <td class="text-danger">
                                        <div><?php echo $team_task["deadline"] ?></div>
                                        <div class="h6 pt-1">Due</div>
                                    </td>
                            <?php }else{ ?>
                                <td class="">
                                <?php echo $team_task["deadline"] ?>
                                </td>
                            <?php 
                            }
                            ?>
                            

                            <td class="">
                                <ul class="list-unstyled my-0">
                                    <li><a class="mb-1 btn btn-sm text-primary" href="new_task.php?team_id=<?php echo $team_task["team_id"]; ?> ">Assign New</a></li>
                                    <li><a class="btn btn-sm text-dark mb-1" href="Update_task.php?task_id=<?php echo $team_task["serial"]; ?> ">Update</a></li>
                                    <li><a class="btn btn-sm text-danger" href="delete_task.php?task_id=<?php echo $team_task["serial"]; ?> ">Delete</a></li>
                                </ul>
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </table>
                    
                </form>
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