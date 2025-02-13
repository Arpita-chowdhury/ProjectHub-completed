<?php 
session_start();
include ("../config/dbConn.php");
include ("../action/admin_login_handler.php");

$sql_3rd_year_teams = "SELECT * FROM proposals WHERE year = '3rd' ";
$result_3rd_year_teams = mysqli_query($conn,$sql_3rd_year_teams);
                                  
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
    <!--supervisor landpage / dashboard section-->
    <div class="">
        <div class="h3 text-light mt-3 ms-5 ps-5">Admin</div>
    </div>
    <hr class="text-light mb-0">
    <!--page content-->
    <div class="container ">
        <div class="row mb-5 pb-5">
            
            <!--sidebar start-->
            <?php include ("admin_sidebar.php"); ?>
            <!--sidebar end-->
            
            
            <div class="col-sm-11 col-md-8 col-lg-8 ">
                <!--tabs-->
                <div class="bg-dark bg-gradient">
                    <ul class="nav nav-tabs justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link text-light bg-dark active" href="3rd_year_teams.php">3rd Year</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light " href="4th_year_teams.php">4th Year</a>
                        </li>
                    </ul>
                </div>

                <div class="bg-secondary p-1">
                    <div class="text-light text-center h5 mt-3">3rd Year Teams</div>
                </div>
                <form class=" " name=""  action="" method="">
                    <table class="table table-striped rounded table-secondary text-center">
                        <tr>
                            <th>Team ID</th>
                            <th>Members</th>
                            <th>Project Title</th>
                            <th>Descipline</th>
                            <th>Year</th>
                            <th>Supervisor</th>
                            <th>Action</th>
                        </tr>
                        <?php while($row = mysqli_fetch_assoc($result_3rd_year_teams)){ ?>
                            <tr rowspan="3">
                            <td class=""> <?php echo $row["team_id"]; ?> </td>
                            <td class="">
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
                            <td><?php echo $row["year"]; ?></td>
                            <td><?php echo $row["assigned_supervisor"]; ?></td>
                            <td><a class="btn btn-sm text-primary" href="team_details.php?team_id=<?php echo $row["team_id"] ?>">see more</a></td>
                            </tr>
                        <?php } ?>
                        
                        
                    </table>
                </form>
                </div>
                </div>
                <!--details end-->
    
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
