<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

$team_id = $_GET["team_id"];

//proposal details
$sql_details = "SELECT * FROM proposals
WHERE team_id = '$team_id' AND approval_status = 'Pending' ";
$result_details = mysqli_query($conn,$sql_details);
$details = mysqli_fetch_assoc($result_details);

//approve proposal
if(isset($_POST["approve_proposal"])){
    $message = $_POST["message"];
    
    $sql_update_old = "UPDATE proposals SET approval_status = 'Approved', message = '$message' WHERE team_id = '$team_id' ";
    $result_update_old = mysqli_query($conn, $sql_update_old);

    if ($result_update_old) {
        echo "<script>
        alert('Proposal Approved');
        window.location.href='approved_proposals.php';
        </script>";
        exit();  
    }
}

//rejectb proposal
if(isset($_POST["reject_proposal"])){
    $message = $_POST["message"];

    $sql_reject_proposal = "UPDATE proposals 
    SET approval_status = 'Rejected' , message = '$message' WHERE team_id = $team_id ";
    $result_reject_proposal = mysqli_query($conn, $sql_reject_proposal);

    if ($result_reject_proposal) {
        echo "<script>
        alert('Proposal Rejected');
        window.location.href='submitted_proposals.php';
        </script>";
        exit();  
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

                    <div class="bg-secondary text-light py-1">
                        <div class="text-center h5 ">Approve Proposal</div>
                        <hr class="mt-0 mb-1">
                    </div>

                        <!--team details-->
                        <div class="row">
                            <!--team info-->
                            <div class="col">

                                <form class="form" name=""  action="" method="post">
                                    <table class="table table-striped table-secondary my-1">
                                        <tr>
                                            <td class="h6">Team Members :</td>
                                            <td class="">
                                            <ol>
                                                <?php
                                                $sql_team_member = "SELECT * FROM user WHERE team_id = $team_id";
                                                $result_team_member = mysqli_query($conn, $sql_team_member );
                                                while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                                    <li><?php echo $team_member["name"] ?></li>
                                                <?php } ?>
                                            </ol>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Project Title</td>
                                            <td><?php echo $details["project_title"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Descipline </td>
                                            <td><?php echo $details["descipline"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Year</td>
                                            <td><?php echo $details["year"] ?></td>
                                        </tr>
                                        <tr >
                                            <td class="h6">Project Proposal</td>
                                            <td class=""><a href="../team/<?php echo $details["proposal"] ?>">See proposal File</a></td>
                                        </tr>
                                        <tr >
                                            <td class="h6">Message</td>
                                            <td><input class="form-control" type="text" name="message" ></td>
                                        </tr>
                                        <tr >
                                            <td colspan="2" align="center">
                                                <button class="btn btn-success btn-sm me-3" name="approve_proposal" >Approve</button>
                                                <button class="btn btn-danger btn-sm" name="reject_proposal">Reject</button>
                                            </td>
                                        </tr>
                                    </table>
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
    <?php include("../inc/foot.php"); ?>
</body>

</html>