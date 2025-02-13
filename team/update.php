<?php
session_start();
include ("../action/team_session.php");
include ("../config/dbConn.php");
include ("../action/team_login_handler.php");
include ("../action/team_details_handler.php");

$task_id = $_GET["task_id"];

$sql_task_update = "SELECT * FROM tasks WHERE serial = '$task_id' ";
$result_task_update = mysqli_query($conn,$sql_task_update);
$task_update = mysqli_fetch_assoc($result_task_update);

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
    <div class="container">
        <div class="row">
            
            <!--sidebar start-->
    <?php include ("../inc/sidebar_user.php"); ?>
    <!--sidebar end-->
            


            <!--project update section-->
            <div class="col-sm-11 col-md-8 col-lg-8">

                <div class="bg-secondary py-1">
                    <div class="text-light text-center h5">Progress Update</div>
                    <hr class="text-light mt-0 mb-1">
                </div>
                
                <!--update form start-->
                <form class="" name=""  action="" method="" enctype="">
                    <table class="table table-borderless table-secondary">
                        <tr>
                            <td class="h6 px-5">Task</td>
                            <td><?php echo $task_update["task"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 px-5">Instruction</td>
                            <td><?php echo $task_update["instruction"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 px-5">Deadline</td>
                            <td class="fw-bold"><?php echo $task_update["deadline"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 px-5">Status</td>
                            <td><?php echo $task_update["progress"] ?></td>
                        </tr>
                        <?php if($task_update["progress"] == 'Completed'){ ?>
                        <tr >
                            <td class="h6 px-5">Your Message</td>
                            <td><?php echo $task_update["message"] ?></td>
                        </tr>
                        <tr>
                            <td class="h5" colspan="2" align="center">Screenshots</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                            <img  width="100%" height="50%" src="<?php echo $task_update["screenshot"] ?>" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <video controls width="100%" height="50%" src="<?php echo $task_update["video"] ?>" alt="">
                            </td>
                        </tr>
                        <tr >
                            <td class="h6 px-5">Supervisor's Comment</td>
                            <td><?php echo $task_update["comment"] ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <a href="project_update.php?task_id=<?php echo $task_update["serial"]?>" class="btn btn-secondary" name="update" value="">Update again</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    
                </form>
                
            </div>

            
        </div>
        
        
        </div>
        <!--upload form end-->
    </div>
</main>
    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include("../action/form_resubmission_handler.php") ?>
</body>

</html>