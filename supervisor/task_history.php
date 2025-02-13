<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

$team_id = $_GET["team_id"];

include ("../action/task_history_handler.php");

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
            <!--team details page-->
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
                <div class="row pb-5">
                    
                    <!--sidebar start-->
                    <?php include ("../inc/sidebar_supervisor.php"); ?>
                    <!--sidebar end-->
                    


                    <!--team Details section-->
                    <div class="col-sm-11 col-md-8 col-lg-8 ">
                        <!--tabs-->
                        <div class="bg-dark bg-gradient">
                            <ul class="nav nav-tabs justify-content-end">
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="team_details.php?team_id=<?php echo $team_id  ?>">Team Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light bg-dark active" href="task_history.php?team_id=<?php echo $team_id  ?>">Task history</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="">Review</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="">Update</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="new_task.php?team_id=<?php echo $team_id  ?>">New Task</a>
                                </li>
                            </ul>
                        </div>

                        <!--team details-->
                        <div class="row">
                            <!--task history-->
                            <div class="col">

                                <form class="" name=""  action="" method="">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Task</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Assigned</th>
                                        <th scope="col">Deadline</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Rejected tasks -->
                                        <?php foreach ($rejected_tasks as $task): ?>
                                        <tr class="table-danger">
                                            <td><?php echo $task['task']; ?></td>
                                            <td class="h6 text-danger">Rejected</td>
                                            <td><?php echo $task['assign_date']; ?></td>
                                            <td><?php echo $task['deadline']; ?></td>
                                            <td></td>
                                        </tr>
                                        <?php endforeach; ?>

                                        <!-- Remaining tasks -->
                                        <?php foreach ($remaining_tasks as $task): ?>
                                        <tr class="table-secondary">
                                            <td><?php echo $task['task']; ?></td>
                                            <td>Remaining</td>
                                            <td><?php echo $task['assign_date']; ?></td>
                                            <td><?php echo $task['deadline']; ?></td>
                                            <td><a class="btn btn-sm" href="update_task.php?task_id=<?php echo $task['serial']; ?>">update</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        
                                        <!-- In-progress tasks -->
                                        <?php foreach ($in_progress_tasks as $task): ?>
                                        <tr class="table-warning">
                                            <td><?php echo $task['task']; ?></td>
                                            <td>In-progress</td>
                                            <td><?php echo $task['assign_date']; ?></td>
                                            <td><?php echo $task['deadline']; ?></td>
                                            <td><a class="btn btn-sm" href="update_task.php?task_id=<?php echo $task['serial']; ?>">update</a></td>
                                        </tr>
                                        <?php endforeach; ?>

                                        <!-- Completed tasks -->
                                        <?php foreach ($completed_tasks as $task): ?>
                                        <tr class="table-success">
                                            <td><?php echo $task['task']; ?></td>
                                            <td>Completed</td>
                                            <td><?php echo $task['assign_date']; ?></td>
                                            <td><?php echo $task['deadline']; ?></td>
                                            <td><a class="btn btn-sm" href="review_task.php?task_id=<?php echo $task['serial']; ?>">review</a></td>
                                        </tr>
                                        <?php endforeach; ?>

                                        <!-- Approved tasks -->
                                        <?php foreach ($approved_tasks as $task): ?>
                                        <tr class="table-success">
                                            <td><?php echo $task['task']; ?></td>
                                            <td class="h6">Approved</td>
                                            <td><?php echo $task['assign_date']; ?></td>
                                            <td><?php echo $task['deadline']; ?></td>
                                            <td></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <!--team details end-->


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