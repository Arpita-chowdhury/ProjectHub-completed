<?php
session_start();
include ("../config/dbConn.php");
include ("../action/team_login_handler.php");
include ("../action/team_details_handler.php");

$team_id = $_GET["team_id"];

$sql_details = "SELECT * FROM completed_projects WHERE team_id = '$team_id' ";
$result_details = mysqli_query($conn, $sql_details);
$details = mysqli_fetch_assoc($result_details);

?>


<!DOCTYPE html>
<html lang="en">
<?php include("../inc/head.php"); ?>
<body class="bg-dark text-light">
    <div class="container">
        <!--body container start-->
        <!--navbar starts here-->
        <header>
            <nav class="navbar navbar-expand-sm sticky-top bg-secondary px-2">
                <!--logo design-->
                <a class="navbar-brand d-flex text-capitalize" href="../index.php" >
                <?php include("../inc/logo.php"); ?>
                </a>
                <!--logo design-->
                <!--navbar collapse button for small screen-->
                <?php include("../inc/nav_collapse.php"); ?>

                <!--navbar links-->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto ">
                        <?php if(isset($_SESSION["team"])){ ?>
                            <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="../index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                            <li class="nav-item me-2" data-toggle="tooltip" data-placement="top" title="Team profile"><a class="nav-link text-light" href="../team/team_dashboard.php"><i class="p-1 fa-solid fa-user border rounded-circle"></i></a></li>
                            <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../action/logout.php">Log out</a></li>
                        <?php }else{ ?>
                            <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="../index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                            <li class="nav-item "><a class="nav-link text-light" href="../login.php">Log In</a></li>
                            <li class="nav-item" ><a class="nav-link text-light" href="../team/team_registration.php">Register</a></li>
                        <?php } ?>
                    </ul>
                </div>
                
            </nav>
        </header>
        <!--navbar ends here-->

        <main class="pb-5">
            <!--project details section-->
            <div class="position-relative bg-gradient">
                <div class="text-center display-6 ps-3 d-inline-block">
                    <?php echo $details["project_title"] ?>
                </div>
                
                <!--Add project button-->
                <div class="d-inline-block position-absolute end-0 pt-3 pe-3">
                    <a href="upload_project.php">
                        <button class="btn btn-secondary btn-sm fw-bold">
                            <i class="me-2 fa-solid fa-share "></i>Share yours
                        </button>
                    </a>
                </div>
                <hr>
            </div>

            <div class="row pb-5">
                <!--team details-->
                
                <div class="col-4 border-end px-3 ">
                    <table class="table table-dark">
                        <tr>
                            <td colspan="2" align="center" class="h5 bg-secondary">Team Details</td>
                        </tr>
                        <tr>
                            <td class="h6">Team Members</td>
                            <td>
                                <ol>
                                    <?php
                                    $sql_team_member = "SELECT * FROM user WHERE team_id = $details[team_id]";
                                    $result_team_member = mysqli_query($conn,$sql_team_member );
                                    while($team_member = mysqli_fetch_assoc($result_team_member)){ ?>
                                        <li><?php echo $team_member["name"] ?></li>
                                    <?php } ?>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td class="h6">Batch</td>
                            <td><?php echo $details["batch"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6">Section</td>
                            <td><?php echo $details["section"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6">Supervisor</td>
                            <td><?php echo $details["supervisor"] ?></td>
                        </tr>
                    </table>    
                </div>

                <!--project details-->
                <div class="col-8 px-5 ">
                <table class="table table-dark table-borderless">
                        <tr>
                            <td colspan="2" align="center" class="h5 bg-secondary">Project Details</td>
                        </tr>
                        <tr>
                            <td class="h6 px-4">Descipline</td>
                            <td><?php echo $details["descipline"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 px-4">Description</td>
                            <td class=""><?php echo $details["description"] ?></td>
                        </tr>
                        <tr>
                            <td class="h6 px-4">Github Repository</td>
                            <td><a class="link-underline link-underline-opacity-0" href="<?php echo $details["github"] ?>">github link</a></td>
                        </tr>
                        <tr>
                            <td class="h6 px-4">File</td>
                            <td><a class="link-underline link-underline-opacity-0" href="<?php echo $details["file"] ?>">File</a></td>
                        </tr>
                        <tr>
                            <td class="h6 px-4">Project experience</td>
                            <td><?php echo $details["experience"] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include("../inc/foot.php") ?>

</body>

</html>