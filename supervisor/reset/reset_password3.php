<?php 
include ("../../config/dbConn.php");
$email =  $_GET["mail"];
 
//reset pass
if(isset($_POST["reset"])){
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if($password == $confirm_password){
        $hashedPassword = md5($password);
        $sql_reset = "UPDATE supervisor SET password = '$hashedPassword' WHERE email = '$email' ";
        $result_reset = mysqli_query($conn, $sql_reset);

        if($result_reset){
            echo "<script>
            alert('Password Reset Successfully.');
            window.location.href='../supervisor_login.php';
            </script>";
            exit();
        }else{
            echo "<script>
            alert('Something went wrong ! Please try again.');
            </script>";
            exit();
        }
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("../../inc/head.php"); ?>
<body class="bg-dark text-light">
<!--The mother container div start-->
<div class="container">
    <!--navbar starts here-->
    <header>
        <nav class="navbar navbar-expand-sm bg-secondary px-2">
            <a class="navbar-brand d-flex text-capitalize" href="../index.php" >
                <?php include("../../inc/logo.php"); ?>
            </a><?php include("../../inc/nav_collapse.php"); ?>
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

<main class="form-container-style ">
    <!--form container start-->
    <div class="container py-4">
        <div class="row ">
            <div class="col-lg-3" ></div>
            <div class="col-sm-12 col-md-10 col-lg-6 mt-4 ">
                
                <!--form-->
                <form method="post">
                    
                    <div class="card px-5 pt-2 mt-3 bg-dark border  shadow">
                        <div class="h5 py-1 mb-0 text-light text-center rounded">
                            Reset Password
                            <hr class="text-light my-1 ">
                        </div>
                        <div>
                            <form action="" method="post">
                            <table class="text-light">
                                <!--reset pass-->
                                <tr>
                                    <td colspan="2" align="center">
                                    <small><p class="form-text text-secondary ">Email verified. <br>Reset your password</p></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label pe-3 fw-bold">New Password</label></td>
                                    <td class="position-relative">
                                        <input id="regPass" class="form-control mt-2 bg-dark text-light" type="password" name="password">
                                        <i class="fa-regular fa-eye btn border-0 text-secondary position-absolute end-0 top-0 pe-2 pt-4" onclick="visibility_toggle_pass()"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label pe-3 fw-bold">Confirm new Password</label></td>
                                    <td class="position-relative">
                                        <input id="regConPass" class="form-control mb-4 mt-2 bg-dark text-light" type="password" name="confirm_password">
                                        <i class="fa-regular fa-eye btn border-0 text-secondary position-absolute end-0 top-0 pe-2 pt-4" onclick="visibility_toggle_conPass()"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                    <button class="btn btn-secondary" type="submit" name="reset" >Reset</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                    <p class="form-text text-secondary pt-4"><small>step 3 of 3</small></p>
                                    </td>
                                </tr>
                                
                            </table>
                            </form>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-lg-3"></div>
            
        </div>
        
        
    </div>
    
</main>

<!--password visibility js code-->
<script src="../../js/password_visibility_toggle.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  
<?php include("../../action/form_resubmission_handler.php"); ?>
<?php include("../../inc/foot.php"); ?>
