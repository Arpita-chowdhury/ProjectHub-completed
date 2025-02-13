<?php
session_start();
include ("../config/dbConn.php");
include ("../action/supervisor_login_handler.php")
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
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../login.php">Log In</a></li>
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../team/team_registration.php">Register</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->

<main>
    <!--register section-->
    <!--form start-->
    <div class="container mt-4 pb-5">
        <div class="row pb-1">
            <div class="col"></div>

            <div class="col-6 mt-5 px-0 bg-dark bg-gradient border border-secondary rounded shadow-lg">
                
                <div class="h3 my-0 py-1 rounded-top text-light text-center">
                    Log In
                    <div class="h6 mb-0 pt-3">(As Supervisor)</div>
                    <hr class="mb-1">
                </div>

                <!--supervisor login-->
                <form class=" rounded-bottom" action="" method="post" autocomplete="off" novalidate>
                    <table class="table table-borderless table-dark pt-5 mb-0">
                        <tr class="mt-4">
                            <td class="h6 ps-4">Email</td>
                            <td class=""><input class="form-control mb-1 bg-dark text-light" placeholder="" type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-4 ">Password</td>
                            <td class="position-relative"><input id="logPass"  class="form-control mb-1 bg-dark text-light" placeholder="" type="password" name="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" required>
                            <i class="fa-regular fa-eye btn border-0 text-secondary position-absolute end-0 top-0 pe-4 pt-3" 
                            onclick="visibility_toggle_loginPass()" ></i>    
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" align="center">
                                <!-- Error msg -->
                                <p class="text-danger fw-bold" style="font-size: 16px;"><?php echo $authenticationErr ; ?></p>

                                <!-- Submit button -->
                                <button class="btn btn-secondary"  name="adminLog" type="submit">Log In</button>
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
    <?php include("../inc/foot.php"); ?>
</body>

</html>