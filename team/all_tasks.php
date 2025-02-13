<?php
session_start();
include ("../action/team_session.php");
include ("../config/dbConn.php");
include ("../action/team_login_handler.php");
include ("../action/team_details_handler.php");
 
//checking
$team_set = false;
$sql_check = "SELECT assigned_supervisor FROM proposals WHERE team_id = '$team_id' ";
$result_check = mysqli_query($conn, $sql_check);
$check = mysqli_fetch_assoc($result_check);
if(isset($check["assigned_supervisor"])){
    $team_set = true; 
}

include ("../action/task_history_handler.php");

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
                    <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="../index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../action/logout.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->

<main>
    <!--user folder heading-->
    <div class="bg-dark bg-gradient text-light py-3">
        <span class="mx-5 px-5 h5 ">Team : <?php echo $team_name ?></span>
        <span class="mx-5 px-5 h6 ">Team ID : <?php echo $team_id ?></span>
        <span class="h6 mx-5" style="" >email : <?php echo $team_email ?></span>
    </div>
    <hr class="text-light mt-0 mb-2">

    <!--page content-->
    <div class="container pb-3">
        <div class="row mb-5 pb-5">
            
            <!--sidebar start-->
    <?php include ("../inc/sidebar_user.php"); ?>
    <!--sidebar end-->
            


            <!--project update section-->
            <div class="col-sm-11 col-md-8 col-lg-8">

                <div class="bg-secondary py-1 text-light">
                    <div class="text-center h5 ">Task List</div>
                    <hr class="mt-0 mb-1">
                </div>

                <!--task table start-->
                <form class="" name=""  action="" method="">
                <table class="table table-striped text-center">
                    <thead>
                        <tr class="table-secondary">
                        <th >Task</th>
                        <th>Status</th>
                        <th >Assigned</th>
                        <th >Deadline</th>
                        <th>Update</th>
                        <th></th>
                        </tr>
                    </thead>
                    <?php if($team_set){ ?>
                        <tbody>
                        <!-- Rejected tasks -->
                        <?php foreach ($rejected_tasks as $task): ?>
                        <tr class="table-danger">
                            <td><?php echo $task['task']; ?></td>
                            <td class="h6 text-danger">Rejected</td>
                            <td><?php echo $task['assign_date']; ?></td>
                            <td><?php echo $task['deadline']; ?></td>
                            <td>
                                <a class="text-primary" href="project_update.php?task_id=<?php echo $task["serial"] ?>" >
                                <i class="fa-solid fa-check-double"></i></a>
                            </td>
                            <td><a class="btn btn-sm" href="update.php?task_id=<?php echo $task['serial'] ?>">see update</a></td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Remaining tasks -->
                        <?php foreach ($remaining_tasks as $task): ?>
                        <tr class="table-secondary">
                            <td><?php echo $task['task']; ?></td>
                            <td>Not Started</td>
                            <td><?php echo $task['assign_date']; ?></td>
                            <td><?php echo $task['deadline']; ?></td>
                            <td>
                                <a class="text-primary" href="project_update.php?task_id=<?php echo $task["serial"] ?>" >
                                <i class="fa-solid fa-check-double"></i></a>
                            </td>
                            <td><a class="btn btn-sm" href="update.php?task_id=<?php echo $task['serial'] ?>">see update</a></td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- In-progress tasks -->
                        <?php foreach ($in_progress_tasks as $task): ?>
                        <tr class="table-warning">
                            <td><?php echo $task['task']; ?></td>
                            <td>In-progress</td>
                            <td><?php echo $task['assign_date']; ?></td>
                            <td><?php echo $task['deadline']; ?></td>
                            <td>
                                <a class="text-primary" href="project_update.php?task_id=<?php echo $task["serial"] ?>" >
                                <i class="fa-solid fa-check-double"></i></a>
                            </td>
                            <td><a class="btn btn-sm" href="update.php?task_id=<?php echo $task['serial'] ?>">see update</a></td>
                        
                        </tr>
                        <?php endforeach; ?>

                        <!-- Completed tasks -->
                        <?php foreach ($completed_tasks as $task): ?>
                        <tr class="table-success">
                            <td><?php echo $task['task']; ?></td>
                            <td>Completed</td>
                            <td><?php echo $task['assign_date']; ?></td>
                            <td><?php echo $task['deadline']; ?></td>
                            <td>    
                                <a class="text-primary" href="project_update.php?task_id=<?php echo $task["serial"] ?>" >
                                <i class="fa-solid fa-check-double"></i></a>
                            </td>
                            <td><a class="btn btn-sm" href="update.php?task_id=<?php echo $task['serial'] ?>">see update</a></td>
                        
                        </tr>
                        <?php endforeach; ?>

                        <!-- Approved tasks -->
                        <?php foreach ($approved_tasks as $task): ?>
                        <tr class="table-success">
                            <td><?php echo $task['task']; ?></td>
                            <td class="fw-bold ">Approved</td>
                            <td><?php echo $task['assign_date']; ?></td>
                            <td><?php echo $task['deadline']; ?></td>
                            <td></td>
                            <td><a class="btn btn-sm" href="update.php?task_id=<?php echo $task['serial'] ?>">see update</a></td>
                        
                        </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                   <?php }else{ ?>
                    <tr>
                        <td colspan="5"  class="text-center text-light p-5 bg-dark" >Your Team has not been assigned to a Supervisor <br>
                        Submit your project proposal for being assigned.
                        </td>
                    </tr>
                <?php } ?>
                </table>
                    
                </form>
                
            </div>

            
        </div>
        
        
        </div>
        <!-- -->
    </div>
</main>
    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include("../inc/foot.php") ?>
</body>

</html>
