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

include ("action/task_update_handler.php");
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
                <form class="" name=""  action="" method="post" enctype="multipart/form-data">
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
                            <td class="h6 px-5">Progress</td>
                            <td>
                                <p class="form-text "><small>Select a progress stage</small></p>
                                <div class="form-check form-check-inline pe-3">
                                    <input class="form-check-input border-secondary" type="radio" name="progress" value="Not Started"
                                    <?php if($task_update["progress"]=='Not Started'){  ?>
                                            checked
                                    <?php } ?> >
                                    Not Started
                                </div>
                                <div class="form-check form-check-inline pe-3">
                                    <input class="form-check-input border-secondary" type="radio" name="progress" value="In-progress"
                                    <?php if($task_update["progress"]=='In-progress'){  ?>
                                            checked
                                    <?php } ?> >
                                    In-progress
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input border-secondary" type="radio" name="progress" value="Completed" 
                                    <?php if($task_update["progress"]=='Completed'){  ?>
                                            checked
                                    <?php }
                                    if(isset($_POST["update"])){
                                        if($_POST["progress"]=='Completed'){  ?>
                                            checked
                                      <?php  }
                                    } ?> >
                                    Completed
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <button class="btn btn-secondary" type="submit" name="update" value="">Update</button>
                            </td>
                        </tr>

                </form>
                <form class="" name=""  action="" method="post" enctype="multipart/form-data">
                        <?php if(isset($_POST["update"])){
                            if($_POST["progress"]=='Completed'){ ?>
                                
                                <tr >
                                <td class="h6 px-5">Screenshot</td>
                                <td>
                                    <p class="form-text mb-0"><small>Add a screenshot that shows your progress</small></p>
                                    <input class="form-control" type="file" name="screenshot" accept="image/*">
                                </td>
                            </tr>
                            <tr >
                                <td class="h6 px-5">Screen Record</td>
                                <td>
                                    <p class="form-text mb-0"><small>You may add a screen record if needed</small></p>
                                    <input class="form-control" type="file" name="screen_record" accept="video/*">
                                </td>
                            </tr>
                            <tr >
                                <td class="h6 px-5">Message</td>
                                <td>
                                    <p class="form-text mb-0"><small>Any message for your supervisor?</small></p>
                                    <textarea class="form-control" name="message" id="" cols="10" rows="3"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <button class="btn btn-secondary" type="submit" name="upload" value="">Upload</button>
                                </td>
                            </tr>
                            <?php } 
                        } ?>
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
    <?php include("../inc/foot.php") ?>
</body>

</html>