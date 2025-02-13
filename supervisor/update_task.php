<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

$task_id = $_GET["task_id"];

//show previous task details 
$sql_select_task = "SELECT * FROM tasks WHERE serial = '$task_id' ";
$result_select_task = mysqli_query($conn, $sql_select_task);
$select_task = mysqli_fetch_assoc($result_select_task);


//for update task
if (isset($_POST["update"])){
    $task = $_POST["task"];
    $instruction = $_POST["instruction"];

    // set the timezone
    date_default_timezone_set('Asia/Dhaka');
    $deadline = date("d-m-Y", strtotime($_POST["deadline"]));
    $progress = "Not Started";

    //update into DB tasks table
    $sql_update_task = "UPDATE tasks SET 
    task = '$task', deadline = '$deadline' , instruction = '$instruction' , progress = '$progress'
    WHERE serial = '$task_id' ";
    $result_update_task = mysqli_query($conn,$sql_update_task);

    if($result_update_task){
        echo "<script>
        alert('Task updated');
        window.location.href='not_started_tasks.php' ;
        </script>";
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("../inc/head.php"); ?>
<body class="bg-dark text-light">
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
    <!--Assign new task section-->
    <div class="">
        <div class="bg-dark bg-gradient text-light py-3">
            <span class="ms-5 me-3 h5 ">
            <i class="fa-solid fa-user-tie me-3"></i><?php echo $supervisor_name ?></span>
            <span class="" style="" >(<?php echo $supervisor_designation ?>)</span>
        </div>
    </div>
    <hr class="text-light mt-0 mb-2">

    

    <!--page content-->
    <div class="container">
        <div class="row">
            
            <!--sidebar start-->
            <?php include ("../inc/sidebar_supervisor.php"); ?>
            <!--sidebar end-->
            


            <!--update data -->
            <div class="col-sm-11 col-md-8 col-lg-8 ">
                <!--tabs-->
                <div class="bg-dark bg-gradient">
                    <ul class="nav nav-tabs justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link text-light " href="team_details.php?team_id=<?php echo $select_task["team_id"]  ?>">Team Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light " href="task_history.php?team_id=<?php echo $select_task["team_id"]  ?>">Task history</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light " href="review_task.php?team_id=<?php echo $team_id  ?>">Review</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light bg-dark active" href="update_task.php?team_id=<?php echo $team_id  ?>">Update</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light " href="new_task.php?team_id=<?php echo $select_task["team_id"]  ?>">New Task</a>
                        </li>
                    </ul>
                </div>

                <div class="bg-secondary p-1">
                    <div class="text-light text-center h5 ">Update Task</div>
                    <hr class="mt-0 mb-1">
                </div>
                

                
                <!--task update form start-->
                <form class="" name=""  action="" method="post">
                    <table class="table table-secondary table-borderless">
                        <tr>
                            <td class="h6 ps-5">Team ID  </td>
                            <td><?php echo $select_task["team_id"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">Team Members </td>
                            <td class="">
                            <ol>
                                <?php
                                $sql_team_member = "SELECT * FROM user WHERE team_id = {$select_task["team_id"]} ";
                                $result_team_member = mysqli_query($conn,$sql_team_member );
                                while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                    <li><?php echo $team_member["name"] ?></li>
                                <?php } ?>
                            </ol>
                            </td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">Project Title</td>
                            <td><?php echo $select_task["project_title"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">Previous Task</td>
                            <td><?php echo $select_task["task"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">New Task</td>
                            <td><input class="form-control border border-secondary" style="background-color: rgba(217,217,217,0.9);" type="text" name="task"></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">Instruction (if any)</td>
                            <td><textarea class="form-control border border-secondary" style="background-color: rgba(217,217,217,0.9);" name="instruction" id="" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">Deadline</td>
                            <td class=""><input class="form-control border border-secondary" style="background-color: rgba(217,217,217,0.9);" type="date" name="deadline"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <button class="btn btn-secondary btn-sm" type="submit" name="update">Update task</button>
                            </td>
                        </tr>
                    </table>
                    
                </form>
                <!--task update form end-->
            </div>
            <!--update task end-->

            
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