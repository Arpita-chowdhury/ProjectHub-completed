<!DOCTYPE html>
<html lang="en">
<?php include("inc/head.php"); ?>
<body class="bg-dark  text-light">
<!--The mother container div start-->
<div class="container">
    <!--navbar starts here-->
    <header>
        <nav class="navbar navbar-expand-sm bg-secondary px-2">
            <a class="navbar-brand d-flex text-capitalize" href="index.php" >
                <?php include("inc/logo.php"); ?>
            </a><?php include("inc/nav_collapse.php"); ?>
            <!--navbar links-->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="login.php">Log In</a></li>
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="team/team_registration.php">Register</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->

<main>
    <!--register section-->
    <!--form start-->
    <div class="container">
    <div class="row mt-5 pt-3">
            <div class="col"></div>

            <div class="col-sm-12 col-md-10 col-lg-7 mt-5 mx-0 px-0 shadow rounded">
                
                <div class="bg-secondary h3 p-3 text-light text-center rounded-top">Log In</div>
                <div class="row my-4 ">
                    <div class="col text-center ">
                        <div class="mx-2 card card-body my-bg-style bg-dark border-0">
                        <a class=" h6 text-light text-decoration-none " href="team/team_login.php">
                        <div><i class="h3 fa-solid fa-people-group text-light"></i></div>
                        As Team</a>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="mx-2 card card-body my-bg-style bg-dark border-0">
                        <a class="h6 text-light text-decoration-none" href="supervisor/supervisor_login.php">
                        <div><i class="h3 fa-solid fa-chalkboard-user text-light"></i></div>
                            As Supervisor</a>
                        </div>
                        
                    </div>
                </div>
                
            </div>

            <div class="col"></div>
        </div>
    </div>
    <!--form end-->
</main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<!--footer section inclusion-->

<footer class="bg-secondary text-center text-light py-3 mt-4 fixed-bottom">
                <div> <span class="h6">PROJECT</span><span class="fw-light small">HUB</span> </div>
                <p class="font-monospace">Project Management System and Repository <br>
                <small>Department Of Computer Science and Engineering, Leading University, Sylhet</small>
                </p>
            </footer>

        <!--The mother container div ending tag-->
        </div>

        <!--Bootstrap JS cdn-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        
    
    </body>

</html>

