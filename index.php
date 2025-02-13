<?php
session_start();
include ("config/dbConn.php");

?>



<!DOCTYPE html>
<html lang="en">
<?php include("inc/head.php"); ?>
<body class="bg-dark text-light">
<!--The mother container div start-->
<div class="container">
    <!--navbar starts here-->
    <header>
        <nav class="navbar navbar-expand-sm bg-secondary px-2">
            <a class="navbar-brand d-flex text-capitalize" href="index.php" >
                <?php include("inc/logo.php"); ?>
            </a>
            <?php include("inc/nav_collapse.php"); ?>
            <!--navbar links-->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto ">
                    <?php if(isset($_SESSION["team"])){ ?>
                        <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                        <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Team profile"><a class="nav-link text-light" href="team/team_dashboard.php"><i class="p-1 fa-solid fa-user border rounded-circle"></i></a></li>
                        <li class="nav-item" ><a class="nav-link text-light" href="action/logout.php">Log out</a></li>
                    <?php }else{ ?>
                        <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                        <li class="nav-item "><a class="nav-link text-light" href="login.php">Log In</a></li>
                        <li class="nav-item" ><a class="nav-link text-light" href="team/team_registration.php">Register</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->

<!--index page main section start-->   
<main>
    <!--project section-->
    <div class="container pb-4">
        <div class="row text-center mb-3 bg-gradient">
            <hr>
            <!--col for banner-->
            <div class="col-sm-12 col-md-8 col-lg-8 p-5">
                <div class="display-5 mb-3">
                Welcome to <span class="text-dark fw-bold">ProjectHub</span> 
                </div>
                <div class="display-6 mb-5">Your Project Management Solution</div>
                <div class="lead ">
                Unlock Collaboration & Elevate Your Project Experience ...
                </div>
            </div>

                <!--col for img-->
            <div class="col-sm-12 col-md-6 col-lg-4 p-5">
                <div>
                <span class="display-2 me-5 pe-4 text-secondary"><i class="fa-solid fa-code"></i></span>
                <span class="display-2 me-4"><i class="fa-regular fa-calendar-days"></i></span>
                </div>
                <span class="display-1 text-secondary"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                <div class="mt-2">
                <span class="display-2 me-5 text-secondary pe-3"><i class="fa-solid fa-sitemap"></i></span>
                <span class="display-2 me-4"><i class="fa-solid fa-list-check"></i></span>
                </div>
            </div>
        </div> 

        <!--row for buttons-->
        <div class="row text-center">
            <div class="col-2"></div>
            <div class="col-4">
                <div class="card card-body m-4 p-4 my-bg-style bg-dark border-secondary shadow">
                    <a class="card-title h5 text-decoration-none stretched-link text-light fw-bold" href="team/team_registration.php" >Start A Project</a>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-body m-4 p-4 my-bg-style bg-dark border-secondary shadow">
                    <a class="card-title h5 text-decoration-none stretched-link text-light fw-bold" href="previous/previous_projects.php" >Get Inspiration</a>
                </div>
            </div>
            <div class="col-2"></div>
        </div>

        <!--Foot portion cards-->
        <div class="container mx-5">
            <div class="row px-5 pt-5">
                <div class="col-md-1 col-lg-2 pt-5">
                    <div class="display-1"><i class="fa-solid fa-street-view"></i></div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-10 card" style="background-color: rgba(77, 77, 51, .1)">
                    <div class="card-body text-light">
                        <div class="card-title h5 py-3">Our Motivation</div>
                        <div class="card-text">
                            <p style="color: rgba(255, 255, 255, .6);">
                            <small>
                            From our experience, we've observed that students often generate creative project ideas during their academic project requirements. However, for beginners, it's not always easy to decide on a project or understand the entire process. As everyone starts as a beginner, they may end up with poor grades and low motivation instead of realizing their brilliant project ideas!
                            <br><br>
                            Our system addresses these challenges head-on. Through extensive research, we've identified common hurdles faced by students and discovered that a little motivation and systematic guidance can transform the entire scenario. Additionally, timing can be a significant obstacle when it comes to communicating with teachers, especially when "time is money."
                            <br>
                            Our application is a try to ease these obstacles.
                            </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row px-5 pt-3">
                <div class="col-lg-2"></div>
                <div class="col-lg-2">
                    <div class="display-1 pe-5 pt-5"><i class="text-secondary fa-solid fa-arrows-turn-to-dots"></i></div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8 card" style="background-color: rgba(77, 77, 51, .1)">
                    <div class="card-body text-light">
                        <div class="card-title h5 py-3">How It Works ?</div>
                        <div class="card-text">
                            <p >
                                <small>
                                <ul style="color: rgba(255, 255, 255, .6);">
                                    <li>Empowering Student-Teacher Collaboration on a Unified Platform</li>
                                    <li>Systematically Manage Your Project</li>
                                    <li>Unlock Ideas for Beginners</li>
                                    <li>Ensure Continuous Supervision</li>
                                    <li>Conquer and construct as you go!</li>
                                    <li>Stay Regular with Updates</li>
                                    <li>Achieve Success Effortlessly!</li>
                                </ul>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="row px-5 pt-3">
                <div class="col-lg-2 pt-5">
                    <div class="display-1"><i class="fa-solid fa-users-viewfinder"></i></div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 card" style="background-color: rgba(77, 77, 51, .1)">
                    <div class="card-body text-light">
                        <div class="card-title h5 py-3">Steps to Follow</div>
                        <div class="card-text">
                            <p>
                                <small>
                                <ul class="" style="color: rgba(255, 255, 255, .6);">
                                    <li>Register Your Team</li>
                                    <li>Login</li>
                                    <li>Request a Supervisor</li>
                                    <li>Finalize Project Proposal</li>
                                    <li>Follow Assigned Tasks</li>
                                    <li>Regular Updates</li>
                                    <li>Schedule Meetings</li>
                                    <li>Certification After Successful Complition</li>
                                    <li> Your completed project will serve as motivation for fellow students!</li>
                                </ul>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-4 pt-5">
                    <div class="lead pt-5 px-3">
                        <em>
                        <i class="fa-solid fa-quote-left"></i>  
                        For The Community <br>
                        From The Community
                        <i class="fa-solid fa-quote-right"></i>
                        </em>
                    </div>
                </div>
            </div>

        </div>
    
        
    </div>

</main>
   
            


    <?php include("inc/foot.php"); ?>

</body>
  
</html>