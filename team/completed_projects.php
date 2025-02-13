<?php 
session_start();
include ("../action/team_session.php");
include ("../config/dbConn.php");
include ("../action/team_login_handler.php");
include ("../action/team_details_handler.php");

$sql_completed = "SELECT * FROM completed_projects
WHERE team_id = '$team_id' AND status = 'completed'";
$result_completed = mysqli_query($conn, $sql_completed);
$completed = mysqli_fetch_assoc($result_completed);
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

<main class="pb-5">
    <div class="bg-dark bg-gradient text-light py-3">
        <span class="mx-5 px-5 h5 ">Team : <?php echo $team_name ?></span>
        <span class="mx-5 px-5 h6 ">Team ID : <?php echo $team_id ?></span>
        <span class="h6 mx-5" style="" >email : <?php echo $team_email ?></span>
    </div>
    <hr class="text-light mt-0 mb-2">

    <!--page content-->
    <div class="container pb-4">
        <div class="row pb-5">
            
            <!--sidebar start-->
            <?php include ("../inc/sidebar_user.php"); ?>
            <!--sidebar end-->

            <!--user dashboard section-->
            <div class="col-sm-11 col-md-8 col-lg-8 mb-5" id="right_sidebar">
                <div class="text-end px-4 bg-gradient">
                    <a class="link-underline link-underline-opacity-0 text-light" href="files/project proposal sample.pdf"><i class="fa-regular fa-file me-2"></i><small>See a sample project report..</small></a>
                </div>
                <hr class="my-1 text-light">
                <div class="bg-secondary py-1">
                    <div class="text-light text-center h5 ">Your Project</div>
                    <hr class="text-light mt-0 mb-1">
                </div>

                <div class="card card-body mt-3 text-light" style="background-color :rgba(0,0,0,.1); ">
                    <?php if(mysqli_num_rows($result_completed)>0){ ?>
                        <table class="">
                        <tr>
                            <th>Project Title</th>
                            <th>Team Members</th>
                            <th>Descipline</th>
                            <th>Supervisor</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="" ><?php echo $completed["project_title"] ?></td>
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
                            <td class=""><?php echo $completed["descipline"] ?></td>
                            <td class=""><?php echo $completed["supervisor"] ?></td>
                            <td><a class="link" href="edit_completed_project.php">Edit</a></td>
                        </tr>
                    </table>
                    <?php } else { ?>
                        <div class="h6 text-center">You haven't completed any project yet .</div>
                    <?php } ?>
                
                </div>
                
                
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