<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

$meeting = $_GET["meeting"];

$sql_select_meeting = "SELECT * FROM meetings WHERE serial = '$meeting' ";
$result_select_meeting = mysqli_query($conn,$sql_select_meeting);
$select_meeting = mysqli_fetch_assoc($result_select_meeting);


//query for reject meeting
if(isset($_POST["reject_meeting"])){
    $status = "rejected";
    $note = $_POST["note"];
    $sql_reject_meeting = "UPDATE meetings
    SET status = '$status' , note = '$note' WHERE serial = '$meeting' ";
    $result_reject_meeting = mysqli_query($conn,$sql_reject_meeting);

    if($result_reject_meeting){
        echo "<script>
        alert('Meeting request Rejected.');
        window.location.href='meeting_requests.php';
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
    <!--Meeting request section section-->
    <div class="">
        <div class="bg-dark bg-gradient text-light py-3">
            <span class="ms-5 me-3 h5 ">
            <i class="fa-solid fa-user-tie me-3"></i><?php echo $supervisor_name ?></span>
            <span class="" style="" >(<?php echo $supervisor_designation ?>)</span>
        </div>
    </div>
    <hr class="text-light mt-0 mb-2">

    <!--page content-->
    <div class="container">
        <div class="row">
            
            <!--sidebar start-->
            <?php include ("../inc/sidebar_supervisor.php"); ?>
            <!--sidebar end-->
            
            <!--table data -->
            <div class="col-sm-11 col-md-8 col-lg-8 ">
                
                <!--reject Meeting-->
                <div class=" text-center">
                    <div class="py-1 bg-secondary">
                        <div class="text-light h5">Reject This Meeting</div>
                        <hr class="text-light mt-0 mb-1">
                    </div>
                </div>
                
                <!--meeting request reject section-->
                <form class="" name=""  action="" method="post">
                    <table class="table table-striped table-borderless table-secondary">
                        <tr>
                            <td class="h6 ps-5">Team ID</td>
                            <td><?php echo $select_meeting["team_id"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">Team Members</td>
                            <td>
                                <ol>
                                    <?php
                                    $sql_team_member = "SELECT * FROM user WHERE team_id = $select_meeting[team_id]";
                                    $result_team_member = mysqli_query($conn,$sql_team_member );
                                    while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                        <li><?php echo $team_member["name"] ?></li>
                                    <?php } ?>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">Subject</td>
                            <td><?php echo $select_meeting["subject"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">Details</td>
                            <td><?php echo $select_meeting["details"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-5">Message (If any)</td>
                            <td><textarea class="form-control" style="background-color: rgba(249, 249, 249, 0.9);" name="note" ></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><button class="btn btn-danger btn-sm" type="submit" name="reject_meeting" value="">Reject</button></td>
                        </tr>
                    </table>
                </form>
                
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