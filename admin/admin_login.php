<?php
session_start();
include ("../config/dbConn.php");
include ("../action/admin_login_handler.php")
?>

<!DOCTYPE html>
<html lang="en">
<?php include("../inc/head.php"); ?>
<body class="bg-dark ">
<!--The mother container div start-->
<div class="container">
    <!--navbar starts here-->
    <header>
        <nav class="navbar navbar-expand-sm bg-secondary px-2">
            <a class="navbar-brand d-flex text-capitalize" href="../index.php" >
                <?php include("../inc/logo.php"); ?>
            </a>
            <?php include("../inc/nav_collapse.php"); ?>
        </nav>
    </header>
<!--navbar ends here-->

<main>
    <!--form start-->
    <div class="container mt-4 pb-5">
        <div class="row py-4">
            <div class="col"></div>

            <div class="col-6 mt-5 pt-2 border rounded  shadow-lg">
                
                <div class="h3  mx-0 px-0 py-2 text-light text-center">
                    Admin
                </div>

                <!--admin login-->
                <form class="" action="" method="post" autocomplete="off" novalidate>
                    <table class="table table-borderless table-dark pt-5">
                        <tr class="mt-4">
                            <td class="h6 ps-4">Email</td>
                            <td class=""><input class="form-control mb-1 bg-dark text-light" placeholder="" type="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td class="h6 ps-4 ">Password</td>
                            <td class="position-relative"><input id="logPass"  class="form-control mb-1 bg-dark text-light" placeholder="" type="password" name="password" required>
                            <i class="fa-regular fa-eye btn border-0 text-secondary position-absolute end-0 top-0 pe-4 pt-3" 
                            onclick="visibility_toggle_loginPass()" ></i>    
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" align="center">
                                <!-- Error msg -->
                                <p class="text-danger fw-bold" style="font-size: 16px;"><?php echo $authenticationErr ; ?></p>

                                <!-- Submit button -->
                                <button class="btn btn-secondary"  name="login" type="submit">Log In</button>
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
    <?php include("../inc/foot.php"); ?>
</body>

</html>