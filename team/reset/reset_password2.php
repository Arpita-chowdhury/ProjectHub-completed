<?php 
include ("../../config/dbConn.php");
$team_email =  $_GET["mail"];
    
//varify otp
if(isset($_POST["varify"])){
    $user_otp = $_POST["user_otp"];

    $sql_varify = "SELECT * FROM otp WHERE email = '$team_email' ";
    $result_varify = mysqli_query($conn, $sql_varify);
    $varify = mysqli_fetch_assoc($result_varify);

    if($varify["otp"]==$user_otp){
        $sql_delete_otp = "DELETE FROM otp WHERE email = '$team_email' ";
        $result_delete_otp = mysqli_query($conn, $sql_delete_otp);
        echo "<script>
        window.location.href='reset_password3.php?mail=$team_email';
        </script>";
        exit();
    }else{
        echo "<script>
        alert('Wrong OTP !');
        </script>";
        exit();
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
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-lg-3" ></div>
            <div class="col-sm-12 col-md-10 col-lg-6 mt-4 ">
                
                <!--form-->
                <form method="post">
                    
                    <div class="card px-5 pt-2  bg-dark border  shadow">
                        <div class="h5 py-1 mb-0 text-light text-center rounded">
                            Reset Password
                            <hr class="text-light my-1 ">
                        </div>
                        <div>
                            <form action="" method="post">
                            <table class="text-light">
                                <!--verify mail-->
                                <tr>
                                    <td colspan="2" align="center">
                                    <small><p class="form-text text-secondary ps-5">Enter the 6 digit OTP sent to <?php echo $team_email ?></p></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label px-5 fw-bold">OTP</label></td>
                                    <td><input class="form-control bg-dark text-light mb-2" type="text" name="user_otp"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                    <button class="btn btn-secondary btn-sm" type="submit" name="varify" >Verify</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                    <p class="form-text text-secondary ps-5 pt-4"><small>step 2 of 3</small></p>
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  
<?php include("../../action/form_resubmission_handler.php"); ?>
<?php include("../../inc/foot.php"); ?>
