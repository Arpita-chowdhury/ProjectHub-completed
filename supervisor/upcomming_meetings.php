<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

//query for scheduled / upcomming meetings
$sql_scheduled_meeting = "SELECT * FROM meetings 
WHERE supervisor = '$supervisor' AND status = 'scheduled' ";
$result_scheduled_meeting = mysqli_query($conn,$sql_scheduled_meeting);

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
            <div class="col-sm-11 col-md-8 col-lg-8 mb-5">
                <!--tabs-->
                <div class="bg-dark bg-gradient">
                    <ul class="nav nav-tabs justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link text-light bg-dark active" href="upcomming_meetings.php">Upcomming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light " href="meeting_requests.php">Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="rejected_meetings.php">Rejected</a>
                        </li>
                    </ul>
                </div>

                <!--upcoming Meetings-->
                <div class=" text-center">
                    <div class="py-1 bg-secondary">
                        <div class="text-light h5">Upcomming Meetings</div>
                    </div>
                    <table class="table table-striped table-bordered ">
                        <tr>
                            <th><i class="fa-regular fa-square-check"></i></th>
                            <th>Project Title</th>
                            <th>Team Members</th>
                            <th>Subject</th>
                            <th>Date & time</th>
                        </tr>
                        <?php
                        while($scheduled_meeting = mysqli_fetch_assoc($result_scheduled_meeting)){ ?>
                            <tr>
                                <td>
                                    <?php 
                                    //mark a meeting as done
                                    if(isset($_POST["done"])){
                                        $meeting = $_POST["done"];
                                        $sql_select_meeting = "SELECT * FROM meetings WHERE serial = '$meeting' ";
                                        $result_select_meeting = mysqli_query($conn, $sql_select_meeting);
                                        $select_meeting = mysqli_fetch_array($result_select_meeting);

                                        $current_date = date("Y-m-d");
                                        
                                        if($select_meeting["date"] < $current_date){
                                            $sql_mark_as_done = "DELETE FROM meetings WHERE serial = '$meeting'";
                                            $result_mark_as_done = mysqli_query($conn, $sql_mark_as_done);

                                            if($result_mark_as_done){
                                                echo"<script>
                                                alert('Meeting is Marked as Done.');
                                                window.location.href='upcomming_meetings.php';
                                                </script> ";
                                                exit();
                                            }
                                        }else{
                                            echo"<script>
                                                alert('Schedule for this Meeting is not exceeded yet! Try to re-schedule instead.');
                                                window.location.href='upcomming_meetings.php';
                                                </script> ";
                                                exit();
                                        }
                                    } ?>
                                    <form action="" method="post">
                                        <button class="btn" type="submit" name="done" data-toggle="tooltip" data-placement="top" title="Mark as Done" value="<?php echo $scheduled_meeting["serial"]; ?>">
                                        <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><?php
                                    $sql_project_title = "SELECT * FROM approved_proposals WHERE team_id = $scheduled_meeting[team_id]";
                                    $result_project_title = mysqli_query($conn,$sql_project_title );
                                    $project_title = mysqli_fetch_assoc($result_project_title);
                                    echo $project_title["project_title"] ?>
                                </td>
                                <td >
                                    <ol>
                                        <?php
                                        $sql_team_member = "SELECT * FROM user WHERE team_id = $scheduled_meeting[team_id]";
                                        $result_team_member = mysqli_query($conn,$sql_team_member );
                                        while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                            <li><?php echo $team_member["name"] ?></li>
                                        <?php } ?>
                                    </ol>
                                </td>
                                <td><?php echo $scheduled_meeting["subject"] ?></td>
                                <td>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><?php echo $scheduled_meeting["date"] ?></li>
                                        <li class="list-group-item"><?php echo $scheduled_meeting["time"] ?></li>
                                        <li class="list-group-item"><a class="btn btn-outline-primary btn-sm" href="reschedule_meeting.php?meeting=<?php echo $scheduled_meeting["serial"]; ?>">Re-schedule</a></li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
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