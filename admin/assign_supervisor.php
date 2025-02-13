<?php 
session_start();
include ("../config/dbConn.php");
include ("../action/admin_login_handler.php");

//query for submitted proposals
$sql_submitted_proposals = "SELECT * FROM proposals Where assigned_supervisor = '' ";
$result_submitted_proposals = mysqli_query($conn, $sql_submitted_proposals );


if(isset($_POST['submit_row'])) {

    $team_id = $_POST['submit_row'];
    $supervisor = $_POST['supervisor'];

    //Update the poposal table data by assigning supervisor
    $sql_assign = "UPDATE proposals SET assigned_supervisor = '$supervisor' WHERE team_id = $team_id";
    $result_assign = mysqli_query($conn,$sql_assign);
    
    // check if assigned
    if ($result_assign) {
        // Confirmation alert
        echo "<script>
        alert('Supervisor Assigned.');
        window.location.href='assign_supervisor.php';
        </script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
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
<div class="">
        <div class="h3 text-light mt-3 ms-5 ps-5">Admin</div>
        <hr class="text-light">
        
            <!--page content-->
            <div class="container mb-5 pb-5 me-0 pe-0">
                <div class="row me-0 pe-0 mb-4 ">
                    
                    <!--sidebar start-->
                    <?php include ("admin_sidebar.php"); ?>
                    <!--sidebar end-->
                    
                    <!--table data -->
                    <div class="col-sm-11 col-md-8 col-lg-8 ">

                        <div class="bg-secondary p-1">
                            <div class="text-light text-center h5 mt-3">Assign Supervisor</div>
                        </div>
                        
                            <table class="table table-striped table-bordered table-secondary text-center">
                                <tr>
                                    <th>Team ID</th>
                                    <th>Team Members</th>
                                    <th>Project Title</th>
                                    <th>Year</th>
                                    <th>Descipline</th>
                                    <th>Supervisor Preference</th>
                                    <th>Assign Supervisor</th>
                                </tr>
                                <?php while($row = mysqli_fetch_assoc($result_submitted_proposals)){ ?>
                                    <tr rowspan="4">
                                    <td><?php echo $row['team_id'] ?></td>
                                    <td >
                                        <ol>
                                            <?php
                                            $sql_team_member = "SELECT * FROM user WHERE team_id = $row[team_id]";
                                            $result_team_member = mysqli_query($conn,$sql_team_member );
                                            while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                                <li><?php echo $team_member["name"] ?></li>
                                            <?php
                                            }
                                            ?>
                                        </ol>
                                    </td>
                                    <td><?php echo $row['project_title'] ?></td>
                                    <td><?php echo $row['year'] ?></td>
                                    <td><?php echo $row['descipline'] ?></td>
                                    <td><?php echo $row['supervisor_preference'] ?></td>
                                    <td>
                                    <form class="" name=""  action="" method="post">
                                    <select class="form-select" name="supervisor">
                                    <option selected></option>
                                    
                                    <?php 
                                    $sql_supervisor = "SELECT * FROM supervisor";
                                    $result_supervisor = mysqli_query($conn,$sql_supervisor);
                                    while($supervisor = mysqli_fetch_assoc($result_supervisor)){ ?>
                                        <option value="<?php echo $supervisor["initial"]; ?>" ><?php echo $supervisor["name"]; ?></option>
                                    <?php } ?>
                                    </select>

                                        <button class="btn btn-secondary" type="submit" name="submit_row" value="<?php echo $row['team_id']; ?>" >Assign</button>
                                    </td>
                                    </form>
                                </tr>
                                
                                <?php } ?>
                            
                            </table>
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