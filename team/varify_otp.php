<?php 
include ("../config/dbConn.php");
$team_email = $_GET["mail"];           

$sql_team = "SELECT * FROM team WHERE team_email = '$team_email' ";
$result_team = mysqli_query($conn, $sql_team);
$team = mysqli_fetch_assoc($result_team);

if(isset($_POST["varify"])){
    $user_otp = $_POST["user_otp"];

    $sql_varify = "SELECT * FROM otp WHERE email = '$team_email' ";
    $result_varify = mysqli_query($conn, $sql_varify);
    $varify = mysqli_fetch_assoc($result_varify);

    if($varify["otp"]==$user_otp){
        $sql_varified = "UPDATE team SET status = 'varified' WHERE team_email = '$team_email' ";
        $result_varified = mysqli_query($conn, $sql_varified);

        $sql_delete_otp = "DELETE FROM otp WHERE email = '$team_email' ";
        $result_delete_otp = mysqli_query($conn, $sql_delete_otp);

        if($result_varified){
            echo "<script>
            alert('Team Registerd Successfully .');
            window.location.href='../index.php';
            </script>";
            exit();
        }
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

<main class="form-container-style">
    <!--Varify otp-->
    <!--form container start-->
    <div class="container pb-5">
        <div class="row ">
            <div class="col-lg-3" ></div>
            <div class="col-sm-12 col-md-10 col-lg-6 ">
                <!--form-->
                <form class="mt-5 " method="post">
                    <div class="card p-5 bg-dark text-light border-secondary">

                        <div class="h5 py-1 mb-0 text-light bg-secondary text-center">
                            Varify Your Email
                            <hr class="text-light my-1 ">
                        </div>

                        <small><p class="card-text text-secondary text-center">Enter the 6 digit OTP sent to <?php echo $team["team_email"] ?></p>
                        </small>
                        <label class="form-label pe-3 mt-3 fw-bold text-center">OTP</label>
                        <input class="form-control mb-2 bg-dark text-light" type="text" name="user_otp">
                        <div class="text-center"><button class="btn btn-secondary btn-sm mx-5" type="submit" name="varify" >Varify</button></div>
                    
                    </div>
                </form>
            </div>
            <div class="col-lg-3"></div>
            
        </div>
        
        
    </div>
    
</main>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  
<?php include("../action/form_resubmission_handler.php"); ?>
<?php include("../inc/foot.php"); ?>
