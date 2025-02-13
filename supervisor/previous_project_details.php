<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

$team_id = $_GET["team_id"];

$sql_previous = "SELECT * FROM completed_projects WHERE team_id = '$team_id' ";
$result_previous = mysqli_query($conn, $sql_previous);
$previous = mysqli_fetch_assoc($result_previous);

if(isset($_POST["approve"])){
    $sql_approve_previous = "UPDATE completed_projects SET status = 'completed' WHERE team_id = '$team_id' ";
    $result_approve_previous = mysqli_query($conn, $sql_approve_previous);

    if($result_approve_previous){
        echo "<script>
        alert('Project Approved and will be Shown on Previous Projects page.');
        window.location.href='previous_approved.php';
        </script>";
        exit();
    }
}

if(isset($_POST["reject"])){
    $sql_reject_previous = "UPDATE completed_projects SET status = 'rejected' WHERE team_id = '$team_id' ";
    $result_reject_previous = mysqli_query($conn, $sql_reject_previous);

    if($result_reject_previous){
        echo "<script>
        alert('Project approval Rejected.');
        window.location.href='approve_previous.php';
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
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../action/logout.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->



        <main>
            <!--Previous project approval section-->
            <div class="">
                <div class="bg-dark bg-gradient text-light py-3">
                    <span class="ms-5 me-3 h5 ">
                    <i class="fa-solid fa-user-tie me-3"></i><?php echo $supervisor_name ?></span>
                    <span class="" style="" >(<?php echo $supervisor_designation ?>)</span>
                </div>
            </div>
            <hr class="text-light mt-0 mb-2">

            

            <!--page content-->
            <div class="container pb-5">
                <div class="row pb-5">
                    
                    <!--sidebar start-->
                    <?php include ("../inc/sidebar_supervisor.php"); ?>
                    <!--sidebar end-->
                    


                    <!--table data -->
                    <div class="col-sm-11 col-md-8 col-lg-8 ">
                        <div class="bg-secondary p-1">
                            <div class="text-light text-center h5">Approve Projects Completed under Your Superviosn</div>
                            <hr class="mt-0 mb-0 text-light">
                        </div>
                        
                        <!--project details-->
                        <div class="" id="details">
                            <div class="h5 text-center text-light bg-gradient">Project Details</div>
                            <form class="" action="" method="post">
                                <table class="table table-secondary table-borderless ">
                                    <tr>
                                        <td class="h6 ps-5">Team Members </td>
                                        <td>
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
                                        <td class="h6 ps-5">Batch </td>
                                        <td><?php echo $previous["batch"] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="h6 ps-5">Section </td>
                                        <td><?php echo $previous["section"] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="h6 ps-5">Project Title</td>
                                        <td><?php echo $previous["project_title"] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="h6 ps-5">Descipline </td>
                                        <td><?php echo $previous["descipline"] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="h6 ps-5">Description </td>
                                        <td><?php echo $previous["description"] ?></td>
                                    </tr>
                                    <tr >
                                        <td class="h6 ps-5">Github Repository</td>
                                        <td><a class="link-underline link-underline-opacity-0" href="<?php echo $previous["github"] ?>">github</a></td>
                                    </tr>
                                    <tr>
                                        <td class="h6 ps-5">File </td>
                                        <td><a class="link-underline link-underline-opacity-0" href="../previous/<?php echo $previous["file"] ?>">File</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <button class="btn btn-success btn-sm me-3" name="approve">Approve</button>
                                            <button class="btn btn-danger btn-sm" name="reject">Reject</button>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </form>
                        </div>
                        <!--project details end-->

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