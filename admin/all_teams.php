<?php 
session_start();
include ("../config/dbConn.php");
include ("../action/admin_login_handler.php");
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
    <hr class="text-light">
    <!--page content-->
    <div class="container ">
        <div class="row mb-5 pb-5">
            
            <!--sidebar start-->
            <?php include ("admin_sidebar.php"); ?>
            <!--sidebar end-->
            
            
            <div class="col-sm-11 col-md-8 col-lg-8 ">
                <!--details-->
                <!--team info-->
                    <div class="col">

                        <div class="bg-secondary p-1">
                            <div class="text-light text-center h5 my-2">Teams</div>
                        </div>
                        <div class="row my-4 ">
                            <div class="col text-center ">
                                <div>
                                <a class=" h6 text-light text-decoration-none" href="3rd_year_teams.php">
                                <div><i class="h3 fa-solid fa-people-line text-secondary"></i></div>
                                3rd Year Teams</a>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div>
                                <a class="h6 text-light text-decoration-none" href="4th_year_teams.php">
                                <div><i class="h3 fa-solid fa-people-group text-secondary"></i></div>
                                    4th Year Teams</a>
                                </div>
                                
                            </div>
                        </div>
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