<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

$team_id = $_GET["team_id"];

//for project details
$sql_details = "SELECT * FROM proposals
WHERE team_id = '$team_id' ";
$result_details = mysqli_query($conn,$sql_details);
$details = mysqli_fetch_assoc($result_details);
$project_title = $details["project_title"];
$descipline = $details["descipline"];
$supervisor = $details["assigned_supervisor"];

//for new task
if (isset($_POST["assign_task"])){
    $task = $_POST["task"];
    $instruction = $_POST["instruction"];

    // set the timezone
    date_default_timezone_set('Asia/Dhaka');

    $current_date = date("Y-m-d");
    $assign_date = date("d-m-Y", strtotime($current_date));

    $assign_time = date("H:i:s");
    $deadline = date("d-m-Y", strtotime($_POST["deadline_date"]));
    $progress = "Not Started";

    //insert into DB tasks table
    $sql_new_task = "INSERT INTO tasks (serial , team_id, project_title, supervisor, task, assign_date , assign_time , deadline, instruction, progress, screenshot, video, message, comment)
    VALUES ('', $team_id , '$project_title' , '$supervisor', '$task' , '$assign_date' , '$assign_time' , '$deadline' , '$instruction' , '$progress' , '' , '' , '' , '' )";

    $result_new_task = mysqli_query($conn,$sql_new_task);

    if($result_new_task){
        echo "<script>
        alert('Task assigned');
        window.location.href='task_history.php?team_id=$team_id' ;
        </script>";
        
    }
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
                    


                    <!--assign new task -->
                    <div class="col-sm-11 col-md-8 col-lg-8 px-4">
                        <!--tabs-->
                        <div class="bg-dark bg-gradient">
                            <ul class="nav nav-tabs justify-content-end">
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="team_details.php?team_id=<?php echo $team_id  ?>">Team Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="task_history.php?team_id=<?php echo $team_id  ?>">Task history</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="">Review</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="">Update</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light bg-dark active" href="new_task.php?team_id=<?php echo $team_id  ?>">New Task</a>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-secondary py-1">
                            <div class="text-light text-center h5 ">Assign a Task</div>
                            <hr class="text-light mt-0 mb-1">
                        </div>
                        
                        
                        <!--task assign form start-->
                        <form class="" name=""  action="" method="post">
                            <table class="table table-striped ">
                                <tr >
                                    <td class="h6 ps-5">Team ID  </td>
                                    <td ><?php echo $team_id ?></td>
                                </tr>
                                <tr>
                                    <td class="h6 ps-5">Team Members </td>
                                    <td class="">
                                        <ol>
                                            <?php
                                            $sql_team_member = "SELECT * FROM user WHERE team_id = $team_id";
                                            $result_team_member = mysqli_query($conn,$sql_team_member );
                                            while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                                <li><?php echo $team_member["name"] ?></li>
                                            <?php } ?>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h6 ps-5">Project Title</td>
                                    <td><?php echo "$project_title" ?></td>
                                </tr>
                                <tr>
                                    <td class="h6 ps-5">Descipline</td>
                                    <td><?php echo "$descipline" ?></td>
                                </tr>
                                <tr>
                                    <td class="h6 ps-5">Task</td>
                                    <td><input class="form-control border border-secondary" type="text" name="task"></td>
                                </tr>
                                <tr>
                                    <td class="h6 ps-5">Instruction (if any)</td>
                                    <td><textarea class="form-control border border-secondary" name="instruction" id="" rows="5"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="h6 ps-5">Deadline</td>
                                    <td class="">
                                        <input class="form-control" name="deadline_date" type="date">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><button class="btn btn-secondary" type="submit" name="assign_task" value="">Assign</button></td>
                                </tr>
                            </table>
                            
                        </form>
                        <!--task assign form end-->
                    </div>
                    <!--assign new task end-->

                    
                </div>
                
                
                </div>
                

            </div>
        </main>


        

    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include("../inc/foot.php"); ?>
    <!--stop form resubmission-->
    <script >
    if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

</html>