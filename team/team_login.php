<?php
session_start();
include ("../config/dbConn.php");
include ("../action/team_login_handler.php")
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
                    <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="../index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../login.php">Log In</a></li>
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="team_registration.php">Register</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->

<main>
    <!--register section-->
    <!--form start-->
    <div class="container mt-3 mb-5 ">
        <div class="row mb-4">
            <div class="col"></div>

            <div class="col-6 mt-5 px-0 bg-dark bg-gradient border border-secondary rounded ">
                
                <div class="h3 my-0 py-1  rounded-top text-light text-center">
                    Log In
                    <div class="h6 mb-0 pt-3">(As Team)</div>
                    <hr class="mb-1">
                </div>
                <!--student login-->
                <div class="boder rounded-bottom ">
                    <form class="" id="student" action="" method="post" autocomplete="off" novalidate>
                        <table class="boder rounded-bottom table table-borderless table-dark mb-0">
                            <tr class="">
                                <td class="h6 ps-4">Team ID / Team Email</td>
                                <td class=""><input class="form-control mb-1 bg-dark text-light" placeholder="" type="text" name="team_identifier" value="<?php echo isset($_POST['team_identifier']) ? htmlspecialchars($_POST['team_identifier']) : ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td class="h6 ps-4 ">Password</td>
                                <td class="position-relative"><input id="logPass"  class="form-control mb-1 bg-dark text-light" placeholder="" type="password" name="logPass" value="<?php echo isset($_POST['logPass']) ? htmlspecialchars($_POST['logPass']) : ''; ?>" required>
                                <i class="fa-regular fa-eye btn border-0 text-secondary position-absolute end-0 top-0 pe-4 pt-3" 
                                onclick="visibility_toggle_loginPass()" ></i>    
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2" align="center">
                                    <!-- Error msg -->
                                    <p class="text-danger fw-bold" style="font-size: 16px;"><?php echo $authenticationErr ;?></p> 
                                    
                                    <!-- Submit button -->
                                    <button class="btn btn-secondary" href="team_dashboard.php?team_id=<?php echo urlencode($team_id); ?>" name="submitLog" type="submit">Log In</button>
                                </td>
                            </tr class="">
                                <td colspan="2" align="center">
                                Don't have an account ? <a class="fw-bold ps-3 link-underline link-underline-opacity-0" href="team_registration.php">Register Now</a>
                                </td>
                            </tr>
                            <tr class="">
                                <td colspan="2" align="center">
                                     <?php
                                    if($authenticationErr){ ?>
                                        <p>Forget password ? <a class="fw-bold ps-3 link-underline link-underline-opacity-0" href="reset/reset_password1.php">Try to Reset</a></p>
                                    <?php } ?>
                                </td>
                            </tr>
                            
                        </table>
                        
                    </form>
                    
                </div>
                        

            </div>
            <div class="col"></div>
        </div>
    </div>
    <!--form end-->
</main>
</div>

<!--password visibility js code-->
<script src="../js/password_visibility_toggle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<?php include("../action/form_resubmission_handler.php") ?>
<?php include("../inc/foot.php") ?>

</body>
</html>