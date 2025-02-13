<?php
session_start();
include ("../action/team_session.php");
include ("../config/dbConn.php");
include ("../action/team_login_handler.php");
include ("../action/team_details_handler.php");
include("action/proposal_submission_handler.php");
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
                    <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="../index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../action/logout.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->

<main>
    <!--user folder heading-->
    <div class="bg-dark bg-gradient text-light py-3">
        <span class="mx-5 px-5 h5 ">Team : <?php echo $team_name ?></span>
        <span class="mx-5 px-5 h6 ">Team ID : <?php echo $team_id ?></span>
        <span class="h6 mx-5" style="" >email : <?php echo $team_email ?></span>
    </div>
    <hr class="text-light mt-0 mb-2">

    <!--page content-->
    <div class="container">
        <div class="row">
            <!--sidebar start-->
            <?php include ("../inc/sidebar_user.php"); ?>
            <!--sidebar end-->

            <div class="col-sm-11 col-md-8 col-lg-8 ">
            
            

            <?php
            if(!$proposal_submitted){ ?>
            <div class="text-end px-4 bg-gradient">
                <a class="link-underline link-underline-opacity-0 text-light" href="files/project proposal sample.pdf"><i class="fa-regular fa-file me-2"></i><small>See a Sample Proposal..</small></a>
            </div>
            <hr class="my-1 text-light">
                
            <!--project proposal submission section-->
            <div class="bg-secondary text-light py-1">
                <div class=" text-center h5 py-1">Submit your Proposal</div>
                <hr class="mt-0 mb-1">
            </div>
                
                <!--proposal upload form start-->
                <form class="" name=""  action="" method="post" enctype="multipart/form-data">
                    <table class="table table-borderless table-striped">
                        <tr>
                            <td class="ps-5">Team ID</td>
                            <td><?php echo $team_id ?></td>
                        </tr>
                        <tr>
                            <td class="ps-5">Project title</td>
                            <td><input class="form-control" type="text" name="project_title"></td>
                        </tr>
                        <tr>
                            <td class="ps-5">Descipline</td>
                            <td >
                                <input  type="radio" id="android" value="android" name="descipline"><label class="form-label me-5 ps-2" for="android">Android</label>
                                <input  type="radio" id="web" value="web" name="descipline"><label class="form-label me-5 ps-2" for="web">Web</label>
                                <input  type="radio" id="others" value="others" name="descipline"><label class="form-label me-5 ps-2" for="others">Others</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-5">Year</td>
                            <td >
                                <input  type="radio" id="" value="3rd" name="year"><label class="form-label me-3 ps-1" for="3rd">3rd</label>
                                <input  type="radio" id="" value="4th" name="year"><label class="form-label me-3 ps-1" for="4th">4th</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-5">Supervisor Preference</td>
                            <td>
                                <p class="form-text">Select the supervisor you prefer</p>
                                <select class="form-select" name="supervisor_preference">
                                    <option selected></option>
                                    
                                <?php 
                                $sql_supervisor = "SELECT * FROM supervisor";
                                $result_supervisor = mysqli_query($conn,$sql_supervisor);
                                while($supervisor = mysqli_fetch_assoc($result_supervisor)){ ?>
                                    <option value="<?php echo $supervisor["initial"]; ?>" ><?php echo $supervisor["name"]; ?></option>
                                <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr >
                            <td class="ps-5">Github Link</td>
                            <td>
                                <p class="form-text">Add a collaborative github repository link with all team mates.</p>
                                <input class="form-control" type="link" name="github_link"></td>
                            </td>
                        </tr>
                        <tr >
                            <td class="ps-5">Proposal</td>
                            <td>
                                <p class="form-text">Upload pdf copy of your project proposal.</p>
                                <input type="file" name="file" class="form-control"  accept=".pdf"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input class="btn btn-secondary" type="submit" name="proposal_submit" value="Submit"></td>
                        </tr>
                    </table>
                    
                </form>
                <?php
                }
                //if proposal submitted / approved
                if(($proposal_submitted || $proposal_approved || $proposal_rejected)){ ?>
                
                <div class="bg-secondary text-light py-1">
                    <div class="text-center h5 ">Submitted!</div>
                    <hr class="mt-0 mb-1">
                </div>
                <form class="" action="" method="post" enctype="multipart/form-data">
                <!--proposal details info start-->
                <table class="table table-striped">
                    <tr>
                        <td class="h6 ps-5">Status</td>
                        <td class="ps-5 text-primary">
                            <?php echo $status ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h6 ps-5">Project title</td>
                        <td class="ps-5"><?php echo $title ?></td>
                    </tr>
                    <tr>
                        <td class="h6 ps-5">Descipline</td>
                        <td class="ps-5"><?php echo $descipline ?></td>
                    </tr>
                    <tr>
                        <td class="h6 ps-5">Year</td>
                        <td class="ps-5"><?php echo $year ?></td>
                    </tr>
                    <tr>
                        <td class="h6 ps-5">Supervisor</td>
                        <td class="ps-5 text-primary"><?php echo $supervisor ?></td>
                    </tr>
                    <tr >
                        <td class="h6 ps-5">Your Proposal</td>
                        <td class="ps-5"><a class="link-underline link-underline-opacity-0" href="<?php echo $proposal ?>">Proposal file</a></td>
                    </tr>
                    <tr>
                        <td class="h6 ps-5">Message</td>
                        <td class="ps-5"><?php echo $message ?></td>
                    </tr>
                    <?php if($proposal_rejected){ ?>
                    <tr>
                        <td class="h6 ps-5">Resubmit Proposal</td>
                        <td class="ps-5">
                            <input type="file" name="new_file" class="form-control"  accept=".pdf"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">    
                            <button class="btn btn-secondary btn-sm me-5" type="submit" name="resubmit">Resubmit</button>
                        </td>
                    </tr>
                   <?php } ?>
                    
                    
                    
                </table>
                </form>
                   
                <?php
                }
                ?>


            </div>

            
            
            

            

            
        </div>
        
        
        </div>
        <!--upload form end-->

    </div>
</main>

    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!--stop form resubmission-->
    <script >
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>

</body>

</html>