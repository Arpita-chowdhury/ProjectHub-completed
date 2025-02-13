<?php
session_start();
include ("../action/team_session.php");
include ("../config/dbConn.php");
include ("../action/team_login_handler.php");
include ("../action/team_details_handler.php");

//bring supervisor details
$sql_supevisor = "SELECT assigned_supervisor FROM proposals WHERE team_id = '$team_id' ";
$result_supervisor = mysqli_query($conn,$sql_supevisor);
$array = mysqli_fetch_array($result_supervisor);
    
if($valid = isset($array["assigned_supervisor"])){
    $supervisor = $array["assigned_supervisor"];
}

//send meeting request to db/ supervisor
if(isset($_POST["request_meeting"])){
    $subject = $_POST["subject"];
    $details = $_POST["details"];
    $status = "pending";

    $sql_request_meeting = "INSERT INTO meetings (serial, team_id, supervisor, subject, details, status, date, time, note)
    VALUES('' , '$team_id' , '$supervisor' , '$subject' , '$details' , '$status' , '' , '' , '')";
    $result_request_meeting = mysqli_query($conn, $sql_request_meeting);
    
    if($result_request_meeting){
        echo "<script>
        alert('A meeting request has been sent to your Supervisor.');
        window.location.href='request_meeting.php';
        </script>";
        exit();
    }
}

//show meeting status and details
$sql_requested_meeting = "SELECT * FROM meetings WHERE team_id = '$team_id' ";
$result_requested_meeting = mysqli_query($conn,$sql_requested_meeting);



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
                    <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="../index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../action/logout.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->

<main>
    <div class="bg-dark bg-gradient text-light py-3">
        <span class="mx-5 px-5 h5 ">Team : <?php echo $team_name ?></span>
        <span class="mx-5 px-5 h6 ">Team ID : <?php echo $team_id ?></span>
        <span class="h6 mx-5" style="" >email : <?php echo $team_email ?></span>
    </div>
    <hr class="text-light mt-0 mb-2">

<!--page content-->
<div class="container">
    <div class="row pb-4">
        
<!--sidebar start-->
<?php include ("../inc/sidebar_user.php"); ?>
<!--sidebar end-->
        


        <!--Request meeting section-->
        <div class="col-sm-11 col-md-8 col-lg-8 ">
            <div class="bg-secondary p-1">
                <div class=" text-light text-center h5">Request A Meeting</div>
                <hr class=" text-light my-1">
            </div>
            
            <!--request meeting form start-->
            <form name=""  action="" method="post" class="">
                <?php if($valid){ ?>
                    <table class="table table-borderless table-secondary text-center">
                    <tr>
                        <td class="h6 px-4">Subject</td>
                        <td><input class="form-control " style="background-color: rgba(249, 249, 249, 0.9);" type="text" name="subject"></td>
                    </tr>
                    <tr>
                        <td class="h6 px-4">Details</td>
                        <td><textarea class="form-control" style="background-color: rgba(249, 249, 249, 0.9);" name="details" id="" ></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><button class="btn btn-secondary btn-sm" type="submit" name="request_meeting" value="">Request</button></td>
                    </tr>
                </table>
                <?php } else{ ?>
                    <div class="text-center p-5">
                    Your Team has not been assigned to a Supervisor <br>
                    Submit your project proposal for being assigned.
                </div>
                <?php } ?>

            </form>
            <!--request meeting form end-->


            <!--requested Meetings-->
            <div class="mt-5 ">
                <div class=" h5 text-light ps-3">Requested Meetings</div>
            </div>
            <hr class="text-light mt-1 mb-2 ">

            
                <table class="table table-striped table-secondary text-center">
                    <tr>
                        <th>Subject</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Message</th>
                        <th><i class="fa-regular fa-square-check"></i></th>
                        
                    </tr>
                    <?php
                    while($requested_meeting = mysqli_fetch_assoc($result_requested_meeting)){ ?>
                    <tr>
                        <td><?php echo $requested_meeting["subject"] ?></td>
                        <td><?php echo $requested_meeting["details"] ?></td>
                        
                        <?php
                        //only show the date and time if meeting request has been approved
                        if($requested_meeting["status"] == "scheduled"){
                            $color = "text-success";
                        }elseif($requested_meeting["status"] == "rejected"){ 
                            $color = "text-danger";
                        }else{
                            $color = "text-dark";
                        } ?>

                        <td class="<?php echo $color ?>"><?php echo $requested_meeting["status"] ?></td>
                        <td ><?php echo $requested_meeting["date"] ?></td>
                        <td><?php echo $requested_meeting["time"] ?></td>
                        <td><?php echo $requested_meeting["note"] ?></td>
                        <td>
                            <?php include("action/requested_meeting_handler.php") ?>
                            <form action="" method="post">
                                <button class="btn" type="submit" name="done" data-toggle="tooltip" data-placement="top" title="Mark as Done" value="<?php echo $requested_meeting["serial"]; ?>">
                                <i class="fa-solid fa-check"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                        
                    <?php } ?>
                </table>
            
            

        </div>

        
    </div>
    
    
    </div>
    <!--upload form end-->

</div>
</main>


        

    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include("../action/form_resubmission_handler.php") ?>
    <?php include("../inc/foot.php") ?>
</body>

</html>