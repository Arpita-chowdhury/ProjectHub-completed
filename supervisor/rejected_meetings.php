<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");


//query for rejected meetings
$sql_rejected_meetings = "SELECT * FROM meetings 
WHERE supervisor = '$supervisor' AND status = 'rejected' ";
$result_rejected_meetings = mysqli_query($conn,$sql_rejected_meetings);

//query for delete a rejected meeting
if(isset($_POST["delete_meeting"])){
    $meeting = $_POST["delete_meeting"];

    $sql_delete_meeting = "DELETE FROM meetings WHERE serial = $meeting";
    $result_delete_meeting = mysqli_query($conn, $sql_delete_meeting);

    if($result_delete_meeting){
        echo "<script>
        alert('Meeting deleted.');
        window.location.href='rejected_meetings.php';
        </script>";
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
    <!--Meeting request section-->
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
        <div class="row mb-5 pb-5">
            
            <!--sidebar start-->
            <?php include ("../inc/sidebar_supervisor.php"); ?>
            <!--sidebar end-->
            


            <!--table data -->
            <div class="col-sm-11 col-md-8 col-lg-8 mb-5 pb-5">
                <!--tabs-->
                <div class="bg-dark bg-gradient">
                    <ul class="nav nav-tabs justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link text-light " href="upcomming_meetings.php">Upcomming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light " href="meeting_requests.php">Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light bg-dark active" href="rejected_meetings.php">Rejected</a>
                        </li>
                    </ul>
                </div>

                <!--rejected Meetings-->
                <div class=" text-center">
                    <div class="py-1 bg-secondary">
                        <div class="text-light h5">Rejected Meetings</div>
                    </div>
                    <form class="" name=""  action="" method="post">
                        <table class="table table-striped table-secondary text-center">
                            <tr>
                                <th>Team ID</th>
                                <th>Team Members</th>
                                <th>Subject</th>
                                <th>Details</th>
                                <th>Your Message</th>
                                <th>Action</th>
                            </tr>

                            <?php
                            while($rejected_meetings = mysqli_fetch_assoc($result_rejected_meetings)){ ?>
                                <tr rowspan="4">
                                <td><?php echo $rejected_meetings["team_id"] ?></td>
                                <td >
                                    <ol>
                                        <?php
                                        $sql_team_member = "SELECT * FROM user WHERE team_id = $rejected_meetings[team_id]";
                                        $result_team_member = mysqli_query($conn,$sql_team_member );
                                        while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                            <li><?php echo $team_member["name"] ?></li>
                                        <?php } ?>
                                    </ol>
                                </td>
                                <td><?php echo $rejected_meetings["subject"] ?></td>
                                <td><?php echo $rejected_meetings["details"] ?></td>
                                <td><?php echo $rejected_meetings["note"] ?></td>
                                <td class="">
                                    <a class="btn btn-outline-secondary btn-sm my-2" name="reschedule" href="reschedule_meeting.php?meeting=<?php echo $rejected_meetings["serial"]; ?>">Re-schedule</a>
                                    <button class="btn btn-outline-danger btn-sm my-2" name="delete_meeting" type="submit" value="<?php echo $rejected_meetings["serial"]; ?>" href="">Delete</button>
                                </td>
                            </tr>
                            <?php  } ?>
                        </table>
                    </form>
                </div>
                
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