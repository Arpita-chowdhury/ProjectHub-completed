<?php 
include ("../../config/dbConn.php");
$not_exixts = "";

//verify email by sending an otp
if(isset($_POST["send_mail"])){
    $email =  $_POST["email"];
    
    include('../../smtp/PHPMailerAutoload.php');
    
    $to_email = $email;
    $sub = "Varify your email";
    $otp = random_int(100000,999999);
    $message = "<p>Hello,</p>
                <p>We received a request for reset your password. Please use the following 6 digit otp to verify your email.</p>
                <p>Your OTP for email verification is: <strong>$otp</strong></p><br>
                <p>Best regards</p>
                <p>ProjectHub Team</p>";
      
    //mailer function
    function smtp_mailer($to,$subject, $msg){
        $mail = new PHPMailer(); 

        //SMTP configuration
        $mail->IsSMTP(); 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; 
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';

        //sender details
        $mail->Username = "projecthub.lu@gmail.com";
        $mail->Password = "huyjbmyfhjjggipt";
        $mail->SetFrom("projecthub.lu@gmail.com");

        //email details
        $mail->Subject = $subject;
        $mail->Body = $msg;

        //recipient
        $mail->AddAddress($to);

        //SMTP option settings
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        

        if(!$mail->Send()){
            echo $mail->ErrorInfo;
        }else{
            return 'sent';
        }
    }

    //check supervisor exists or not
    $sql_check = "SELECT * FROM supervisor WHERE email = '$email' ";
    $result_check = mysqli_query($conn, $sql_check);
    $check = mysqli_fetch_assoc($result_check);
    
    //if exists, send mail
    if(mysqli_num_rows($result_check) > 0){
        $sent_mail = smtp_mailer($to_email, $sub, $message);

        //upload the otp into otp table
        $sql_otp = "INSERT INTO otp (serial , email , otp)
        VALUES ('' , '$email' , $otp) ";
        $result_otp = mysqli_query($conn, $sql_otp);

        echo "<script>
        window.location.href='reset_password2.php?mail=$email';
        </script>";
        exit();
    }else{
        $not_exixts = "This email is not registered. Please contact with Admin.";
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
        <div class="row pt-4 pb-5">
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
                                <!--send mail-->
                                <tr>
                                    <td colspan="2" align="center">
                                    <small><p class="form-text text-secondary text-center ps-5">Please verify your email</p></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label px-5 fw-bold">email</label></td>
                                    <td><input class="form-control mt-3 bg-dark text-light" type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                    <p class="form-text text-warning"><small><?php echo $not_exixts ?></small></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                    <button class="btn btn-secondary btn-sm" type="submit" name="send_mail" >Send email</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                    <p class="form-text text-secondary pt-4"><small>step 1 of 3</small></p>
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
