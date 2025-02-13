<?php 
session_start();
include ("../action/admin_session.php");
include ("../config/dbConn.php");
include ("../action/admin_login_handler.php");

$team_id = $_GET["team_id"];
//details
$sql_details = "SELECT * FROM proposals
WHERE team_id = '$team_id' ";
$result_details = mysqli_query($conn,$sql_details);
$details = mysqli_fetch_assoc($result_details);

//change supervisor
if(isset($_POST["change"])){
    $supervisor = $_POST["supervisor"];

    //change in project table
    $sql_change = "UPDATE proposals SET assigned_supervisor = '$supervisor' WHERE team_id = '$team_id' ";
    $result_change = mysqli_query($conn,$sql_change);

    //change in task table
    $sql_change_task = "UPDATE tasks SET supervisor = '$supervisor' WHERE team_id = '$team_id' ";
    $result_change_task = mysqli_query($conn,$sql_change_task);

    //change in meeting table
    $sql_change_meeting = "UPDATE meetings SET supervisor = '$supervisor' WHERE team_id = '$team_id' ";
    $result_change_meeting = mysqli_query($conn,$sql_change_meeting);


    if($result_change && $result_change_task && $result_change_meeting){
        echo "<script>
        alert('Supervisor changed.');
        window.location.href='team_details.php?team_id=$team_id';
        </script>";
        exit(); 
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
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="admin_logout.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->


<main>
    <!--supervisor landpage / dashboard section-->
    <div class="bg-gradient">
        <div class="h3 text-light ms-5 ps-5">Admin</div>
    </div>
    <hr class="text-light">
    <!--page content-->
    <div class="container ">
        <div class="row mb-5 pb-5">
            
            <!--sidebar start-->
            <?php include ("admin_sidebar.php"); ?>
            <!--sidebar end-->
            
            <div class="col-sm-11 col-md-8 col-lg-8 ">
                
                <!--team details-->
                <div class="row">
                    <!--team info-->
                    <div class="col">

                        <form class="" name=""  action="" method="">
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
                                <tr>
                                    <td class="h6 ps-5">Supervisor</td>
                                    <td><?php echo $details["assigned_supervisor"] ?></td>
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
                        </form>

                        <!--change supervisor-->
                        <div class="mt-3 ">
                        <form class="" name=""  action="" method="post" enctype="">
                            <table class="table table-borderless table-secondary ">
                                <tr>
                                    <td class="ps-5 h6">Change Supervisor</td>
                                    <td>
                                        <select class="form-select " name="supervisor">
                                        <option class="form-select " selected></option>
                                        <?php 
                                        $sql_supervisor = "SELECT * FROM supervisor";
                                        $result_supervisor = mysqli_query($conn,$sql_supervisor);
                                        while($supervisor = mysqli_fetch_assoc($result_supervisor)){ ?>
                                            <option value="<?php echo $supervisor["initial"]; ?>" ><?php echo $supervisor["name"]; ?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <button class="btn btn-secondary me-5" type="submit" name="change">Change</button>
                                    </td>
                                </tr>
                            </table>
                             
                         </form>
                        </div>
                    </div>
                </div>
                <!--team details end-->


                    </div>
              </div>

            
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