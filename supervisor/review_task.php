<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

$task_id = $_GET["task_id"];

//task update details
$sql_task_update = "SELECT * FROM tasks WHERE serial = '$task_id' ";
$result_task_update = mysqli_query($conn,$sql_task_update);
$task_update = mysqli_fetch_assoc($result_task_update);
$team_id = $task_update['team_id'];
//review task progress
if(isset($_POST["approve"])){
    $comment = $_POST["comment"];
    $sql_review = "UPDATE tasks SET progress = 'Approved' WHERE serial = '$task_id' ";
    $result_review = mysqli_query($conn,$sql_review);

    if($result_review){
        echo "<script>
        alert('Task Progress approved.');
        window.location.href='task_history.php?team_id=$team_id' ;
        </script>";
        
    }
}

if(isset($_POST["reject"])){
    $comment = $_POST["comment"];
    $sql_review = "UPDATE tasks SET progress = 'Rejected' WHERE serial = '$task_id' ";
    $result_review = mysqli_query($conn,$sql_review);

    if($result_review){
        echo "<script>
        alert('Task Progress Rejected.');
        window.location.href='task_history.php?team_id=$team_id' ;
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
                                    <a class="nav-link text-light " href="team_details.php?team_id=<?php echo $task_update["team_id"]  ?>">Team Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="task_history.php?team_id=<?php echo  $task_update["team_id"]  ?>">Task history</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light bg-dark active" href="review_task.php?task_id=<?php echo $task_update["serial"]  ?>">Review</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="">Update</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light " href="new_task.php?team_id=<?php echo $task_update["team_id"]  ?>">New Task</a>
                                </li>
                            </ul>
                        </div>

                        <!--team details-->
                        <div class="row">
                            <!--team info-->
                            <div class="col">

                            <div class="bg-secondary py-1">
                                <div class="text-light text-center h5">Progress Update</div>
                                <hr class="text-light mt-0 mb-1">
                            </div>
                            
                            <!--update form start-->
                            <form class="" name=""  action="" method="post" enctype="">
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
                                        <td class="h6 px-5">Message from Team</td>
                                        <td><?php echo $task_update["message"] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="h5" colspan="2" align="center">Screenshots</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                        <img  width="100%" height="50%" src="../team/<?php echo $task_update["screenshot"] ?>" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <video controls width="100%" height="50%" src="../team/<?php echo $task_update["video"] ?>" alt="">
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="h6 px-5">Supervisor's Comment</td>
                                        <td><input class="form-control" type="text" name="comment"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <button class="btn btn-success me-4" name="approve" type="submit" value="">Approve</button>
                                            <button class="btn btn-danger" name="reject" type="submit" value="">Reject</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                                
                            </form>
                        </div>
                        </div>
                        <!--end-->


                    </div>

                    
                </div>
                
                
                </div>
                

            </div>
        </main>


        

    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include("../action/form_resubmission_handler.php") ?>
    <?php include("../inc/foot.php"); ?>
</body>

</html>