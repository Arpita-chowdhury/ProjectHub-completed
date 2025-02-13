<?php 
session_start();
include ("../action/team_session.php");
include ("../config/dbConn.php");
include ("../action/team_login_handler.php");
include ("../action/team_details_handler.php");
//team and project details
$sql_details = "SELECT * FROM proposals WHERE team_id = '$team_id' AND approval_status = 'Approved' ";
$result_details = mysqli_query($conn , $sql_details);
$details = mysqli_fetch_assoc($result_details);

//task details
$sql_task_details1 = "SELECT * FROM tasks WHERE team_id = '$team_id' AND progress = 'Not Started'";
$result_task_details1 = mysqli_query($conn , $sql_task_details1);

$sql_task_details2 = "SELECT * FROM tasks WHERE team_id = '$team_id' AND progress = 'In-progress'";
$result_task_details2 = mysqli_query($conn , $sql_task_details2);

$sql_task_details3 = "SELECT * FROM tasks WHERE team_id = '$team_id' AND progress = 'Completed'";
$result_task_details3 = mysqli_query($conn , $sql_task_details3);


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

<main class="pb-4">
    <!--user landpage / dashboard section-->
    <div class="bg-dark bg-gradient text-light py-3">
        <span class="mx-5 px-5 h5 ">Team : <?php echo $team_name ?></span>
        <span class="mx-5 px-5 h6 ">Team ID : <?php echo $team_id ?></span>
        <span class="h6 mx-5" style="" >email : <?php echo $team_email ?></span>
    </div>
    <hr class="text-light mt-0 mb-2">

    <!--page content-->
    <div class="container pb-5">
        <div class="row pb-5">
            
            <!--sidebar start-->
            <?php include ("../inc/sidebar_user.php"); ?>
            <!--sidebar end-->

            <!--user dashboard section-->
            <div class="col-sm-11 col-md-8 col-lg-8 mb-5" id="right_sidebar">
                <div class="bg-secondary py-2">
                    <div class="text-light text-center h4 ">Dashboard</div>
                    <hr class="text-light mt-0 mb-1">
                </div>
                
                <table class="table table-secondary table-striped align-middle"">
                        <tr>
                            <td class="h6 ps-5">Team Members </td>
                            <td class="">
                                <ol>
                                    <?php
                                    //show team members from user table 
                                    while($row=mysqli_fetch_array($result)){ 
                                        $name = $row["name"]; ?>
                                        <li><?php echo $name ?></li>
                                    <?php   
                                    }?>
                                </ol>
                            </td>
                        </tr>
                        

                        <?php if(mysqli_num_rows($result_details) > 0){ ?>
                        <tbody class="" id="">
                            <tr>
                                <td class="h6 ps-5">Current Project</td>
                                <td><?php echo $details["project_title"] ?></td>
                            </tr>
                            <tr>
                                <td class="h6 ps-5">Descipline </td>
                                <td><?php echo $details["descipline"] ?></td>
                            </tr>
                            <tr>
                                <td class="h6 ps-5">Supervisor</td>
                                <td><?php echo $details["assigned_supervisor"] ?></td>
                            </tr>
                            <tr >
                                <td class="h6 ps-5">Github Repository</td>
                                <td><a href="<?php echo $details["github"] ?>">github</a></td>
                            </tr>
                            <tr >
                                <td class="h6 ps-5">Task Completed</td>
                                <td class="fs-5 fw-bold">
                                    <?php echo $completed = mysqli_num_rows($result_task_details3) ?>
                                </td>
                            </tr>
                            <tr>
                                <td  class="h6 ps-5">Task In-progress</td>
                                <td class="fs-5 fw-bold">
                                    <?php echo $in_progress = mysqli_num_rows($result_task_details2) ?>
                                </td>
                            </tr>
                            <tr>
                                <td  class="h6 ps-5">Task Remaining</td>
                                <td class="fs-5 fw-bold">
                                    <?php echo $not_started = mysqli_num_rows($result_task_details1) ?>
                                </td>
                            </tr>
                        </tbody>
                       <?php } ?>
                        
                        
                    </table>
                
            </div>

            
        </div>
        
        
        </div>
        

    </div>
</main>
    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<?php include("../inc/foot.php") ?>
</body>

</html>