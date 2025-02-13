<?php 
session_start();
include("../action/supervisor_session.php");
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php");
include("../action/supervisor_details_handler.php");

$supervisor = $_SESSION["supervisor"];
$sql_supervising_teams = "SELECT * FROM proposals
WHERE assigned_supervisor = '$supervisor' AND approval_status = 'pending' AND year='4th' ";
$result_supervising_teams = mysqli_query($conn, $sql_supervising_teams);
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
    <!--supervising teams section-->
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
                        <?php  ?>
                        <li class="nav-item">
                            <a type="submit" class="nav-link text-light " href="approved_proposals.php">Approved</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="proposal_3rd_year.php">3rd Year</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light bg-dark active" href="proposal_4th_year.php">4th Year</a>
                        </li>
                    </ul>
                </div>

                <div class="bg-secondary py-1">
                    <div class="text-light text-center h5 ">Submitted Proposals</div>
                    <hr class="text-light mt-0 mb-1">
                </div>
                
                
                
                <form class="" name=""  action="" method="">
                    <table class="table table-striped table-bordered text-center table-secondary">
                        <tr>
                            <th>Team Members</th>
                            <th>Project Title</th>
                            <th>Descipline</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        while($row = mysqli_fetch_assoc($result_supervising_teams)){ ?>
                            <tr rowspan="4">
                            <td >
                                <ol>
                                    <?php
                                    $sql_team_member = "SELECT * FROM user WHERE team_id = $row[team_id]";
                                    $result_team_member = mysqli_query($conn,$sql_team_member );
                                    while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                        <li><?php echo $team_member["name"] ?></li>
                                    <?php } ?>
                                </ol>
                            </td>
                            <td><?php echo $row["project_title"]; ?></td>
                            <td><?php echo $row["descipline"]; ?></td>
                            <td>
                                <div><a class="text-primary link-underline link-underline-opacity-0 mb-2" href="approve_proposal.php?team_id=<?php echo $row['team_id']; ?>">Proposal</a></div>
                            </td>
                            </tr>
                        <?php } ?>
                        
                        
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
    <?php include("../inc/foot.php"); ?>
</body>

</html>