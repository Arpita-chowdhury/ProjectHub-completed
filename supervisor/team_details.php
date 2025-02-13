<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

$team_id = $_GET["team_id"];

//project details
$sql_details = "SELECT * FROM proposals
WHERE team_id = '$team_id' ";
$result_details = mysqli_query($conn,$sql_details);
$details = mysqli_fetch_assoc($result_details);

//to check project is completed or not
$sql_certified = "SELECT * FROM completed_projects WHERE team_id = '$team_id' AND status = 'Completed'";
$result_certified = mysqli_query($conn, $sql_certified);

if(isset($_POST["completed"])){
    //to certify as completed, copy details from proposal to completed_proposal table
    $sql_certify = "INSERT INTO completed_projects (team_id, project_title, descipline, supervisor, github)
    SELECT team_id, project_title, descipline, assigned_supervisor, github
    FROM proposals
    WHERE team_id = '$team_id' ";
    $result_certify = mysqli_query($conn, $sql_certify);

    //update the status
    $sql_update_status = "UPDATE completed_projects SET status = 'completed' WHERE team_id = '$team_id' ";
    $result_update_status = mysqli_query($conn, $sql_update_status);

    //then delete the project from proposals table
    $sql_complete = "DELETE FROM proposals WHERE team_id = '$team_id' ";
    $result_completed = (mysqli_query($conn, $sql_complete));
    
    //confirmation alert
    if($result_certify){
        echo "<script>
        alert('Certified.');
        window.location.href='completed_projects.php';
        </script>";
        exit(); 
    }else{
        echo "Something went wrong!";
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
                                    <a class="nav-link text-light bg-dark active" href="team_details.php?team_id=<?php echo $team_id  ?>">Team Details</a>
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
                                    <a class="nav-link text-light " href="new_task.php?team_id=<?php echo $team_id  ?>">New Task</a>
                                </li>
                            </ul>
                        </div>

                        <!--team details-->
                        <div class="row">
                            <!--team info-->
                            <div class="col">

                                <form class="" name=""  action="" method="post">
                                    <table class="table table-striped table-secondary my-1">
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
                                            <td><?php echo $details["project_title"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-5">Descipline </td>
                                            <td><?php echo $details["descipline"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-5">Year</td>
                                            <td><?php echo $details["year"] ?></td>
                                        </tr>
                                        <tr >
                                            <td class="h6 ps-5">Project Proposal</td>
                                            <td class=""><a class="link-underline link-underline-opacity-0" href="../team/<?php echo $details["proposal"] ?>">See proposal File</a></td>
                                        </tr>
                                        <tr >
                                            <td class="h6 ps-5">Github Repository</td>
                                            <td><a class="link-underline link-underline-opacity-0" href="<?php echo $details["github"] ?>">Visit link</a></td>
                                        </tr>
                                    </table>
                                    <div class="row">
                                        <div class="col-4"></div>
                                        <div class="col-4 mt-2">
                                            <?php if(mysqli_num_rows($result_certified)>0){ ?>
                                                <button type="" name="" class="btn btn-success">
                                                <i class="fa-solid fa-check-to-slot pe-2"></i>
                                                Certified !
                                                </button>
                                            <?php }else{ ?>
                                                <form action="" method="post">
                                                <button type="" name="completed" class="btn btn-secondary">
                                                    <i class="fa-solid fa-check-to-slot pe-2"></i>
                                                    Certify as Completed
                                                </button>
                                                </form>
                                            <?Php } ?>
                                            
                                        </div>
                                        <div class="col-4"></div>
                                    </div>
                                    
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
    <?php include("../action/form_resubmission_handler.php") ?>
    <?php include("../inc/foot.php"); ?>
</body>

</html>