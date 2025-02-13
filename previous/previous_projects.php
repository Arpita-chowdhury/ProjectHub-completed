<?php
session_start();
include ("../config/dbConn.php");

//upload a project button
if(isset($_POST["contribute"])){
    if (!isset($_SESSION["team"])) {
        header("Location: ../team/team_login.php"); // Redirect to login page if not logged in
        exit();
    }else{
        header("Location: upload_project.php"); // Redirect to upload page if logged in
        exit();
    }
}

//select previously completed projects
$sql_completed = "SELECT * FROM completed_projects WHERE status = 'completed' ";
$result_completed = mysqli_query($conn, $sql_completed);
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
            <!---banner-->
            <div class="text-center py-3 px-3 bg-gradient">
                <div class="display-6 ">
                Explore the wide array of projects completed by CSE family. <br> 
                </div>
                <p class="lead pt-3"><em>Get inspired and gain insights from previous endeavors !</em></p>
            </div>

            <!--previous project section-->
            <div class="position-relative mt-2">
            <hr class="mt-1">
            
                <div class="text-center h4 ps-4 d-inline-block">
                Previous Projects
                </div>
                
                <!--Add project button-->
                <div class="d-inline-block position-absolute end-0">
                    <form action="" method="post">
                        <a href="upload_project.php">
                            <button class="btn btn-secondary btn-sm fw-bold me-4" name="contribute">
                                Contribute here <i class="fa-solid fa-plus fa-lg fw-bolder"></i>
                            </button>
                        </a>
                    </form>
                </div>
            </div>
            

            <!--previous project cards containerr-->
            <div class="mt-3 p-3 ">

                <div class="row ">
                    
                    <!--card-->
                    <?php while($completed = mysqli_fetch_assoc($result_completed)){ ?>

                    <div class="col-sm-12 col-md-4 col-lg-3 my-2 border-0 shadow card bg-dark text-light">
                        <div class="card-body ">
                            <div class="card-title bg-secondary h5 p-2 text-light"><?php echo $completed["project_title"] ?></div>
                            <hr>
                            <p class="card-text">
                            <?php echo $completed["description"] ?>
                            </p>
                            <a class="stretched-link text-decoration-none" href="project_details.php?team_id=<?php echo $completed["team_id"] ?>">see more</a>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                
                </div>
            
            </div>
            <!--previous project cards containerr end-->
            
            <!--pagination start-->
            <div class="position-relative">
                <nav class="position-absolute end-0 ">
                    <ul class="pagination ">
                      <li class="page-item"><a class="page-link bg-dark text-secondary border border-secondary" href="#">Previous</a></li>
                      <li class="page-item"><a class="page-link bg-dark text-secondary border border-secondary" href="#">1</a></li>
                      <li class="page-item"><a class="page-link bg-dark text-secondary border border-secondary" href="#">2</a></li>
                      <li class="page-item"><a class="page-link bg-dark text-secondary border border-secondary" href="#">3</a></li>
                      <li class="page-item"><a class="page-link bg-dark text-secondary border border-secondary" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
            <!--pagination end-->
            

        </main>
        
    </div>
    <!--body container ends-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include("../action/form_resubmission_handler.php") ?>
    <?php include("../inc/foot.php") ?>
</body>

</html>