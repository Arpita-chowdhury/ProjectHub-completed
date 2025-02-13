<?php 
include ("../config/dbConn.php");


//generating team id by using random_int function
$randomNumber = random_int(100000,999999);
$teamID = $randomNumber;

//field validation file
include ("../action/validation.php");
  

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
    <!--register section-->
    <!--form container start-->
    <div class="container ">
        <div class="row ">
            <div class="col-lg-4 p-5 text-center">
                <div class="pt-5 display-4 py-1 text-secondary"><i class="fa-solid fa-people-group"></i></div>
                <div class=" ">
                    <div class="display-2 py-1">Register</div>
                    <div class="display-2 py-1">your</div>
                    <div class="display-1 text-secondary py-1">TEAM</div>
                </div>
                <div class="lead pt-5">
                Join and unleash your creativity!<br> Register your team to embark on an exciting journey of collaboration and innovation.
                </div>
            </div>
            
            <div class="col-sm-12 col-md-10 col-lg-7 mt-4 ">
                
                <!--form-->
                <form id="regForm" class="rounded mb-0 " needs-validation 
                action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post" autocomplete="off" novalidate submit>
                    <div class="h4 py-1 mb-0 text-light bg-secondary text-center">
                        Team Registration
                        <hr class="text-light my-1 ">
                    </div>
                    <table class="table table-borderless rounded table-secondary">
                        <tr>
                            <td class="h6 pt-3 ps-5">Team ID</td>
                            <td  class="pe-4">
                                <input class="form-control h6 fw-bold" type="Text" name="teamID" value="<?php echo $teamID; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td class="h6 pt-3 ps-5">Team Name</td>
                            <td  class="pe-4">
                                <input class="form-control mb-1 " placeholder="" type="Text" value="<?php echo isset($_POST['teamName']) ? htmlspecialchars($_POST['teamName']) : ''; ?>" name="teamName" required>
                                
                            </td>
                        </tr>
                        <tr>
                            <td class="h6 pt-3 ps-5">Team Email</td>
                            <td  class="pe-4">
                                <input class="form-control h6 " type="Text" value="<?php echo isset($_POST['teamEmail']) ? htmlspecialchars($_POST['teamEmail']) : ''; ?>" name="teamEmail" required>
                                <p class="text-danger mb-0 pb-1" style="font-size: 13px;"><?php echo $teamEmailErr ?></p>
                                
                            </td>
                        </tr>
                        <tr class="bg-light">
                            <td class="h6 pt-5 ps-5 ">Member 1</td>
                            <td class="pe-4">
                                <div class="form-input">
                                    <label class="form-label mb-0" for="">Student ID</label>
                                    <input id="sid" class="form-control" placeholder="123 456 7890" value="<?php echo isset($_POST['id'][0]) ? htmlspecialchars($_POST['id'][0]) : ''; ?>" type="text" name="id[]" minlength="10" maxlength="10" >
                                    <p class="text-danger mb-0 pb-1" style="font-size: 13px;"><?php echo $idErr ?> </p>
                                </div>

                                <div class="form-input">
                                    <label class="form-label mb-0" for="">Name</label>
                                    <input id="name" class="form-control" placeholder="member name" type="text" value="<?php echo isset($_POST['name'][0]) ? htmlspecialchars($_POST['name'][0]) : ''; ?>" name="name[]" >
                                    <p class="text-danger mb-0 pb-1" style="font-size: 13px;"><?php echo $nameErr ?></p>
                                </div>
                                
                                <div class="form-input">
                                    <label class="form-label mb-0" for="">Email</label>
                                    <input id="email" class="form-control" placeholder="example@gmail.com" type="text" value="<?php echo isset($_POST['email'][0]) ? htmlspecialchars($_POST['email'][0]) : ''; ?>" name="email[]" >
                                    <p class="text-danger mb-0 pb-1" style="font-size: 13px;"><?php echo $emailErr ?></p>
                                </div>

                                <div class="form-input">
                                    <label class="form-label mb-0" for="">Phone</label>
                                    <input id="phone" class="form-control" placeholder="01234 567890" type="text"  minlength="11" maxlength="11" value="<?php echo isset($_POST['phone'][0]) ? htmlspecialchars($_POST['phone'][0]) : ''; ?>" name="phone[]" >
                                    <p class="text-danger mb-0 pb-1" style="font-size: 13px;"><?php echo $phoneErr ?></p>
                                </div>
                                
                            </td>
                        </tr>
                        <!--add member dynamically , using js, through id, from file action/add_team_member.php-->
                        <tbody class="" id="addRow">
                            <!--row will be added here-->
                        </tbody>

                        <!--add button-->
                        <tr>
                            <td colspan="2" align="center">
                                <button type="button" data-bs-toggle="collapse" href="#mem2" class="btn btn-transparent btn-outline-secondary fw-bold " onclick="addMember();">Add Member<i class="fa-solid fa-plus fw-bold ms-1"></i></button>
                            </td>
                        </tr>

                        <tr >
                            <td class="h6 pt-3 ps-5 ">Password</td>
                            <td class="position-relative">
                            <div class="form-input">
                                <input id="regPass" class="form-control mb-1" placeholder="" type="password" value="<?php echo isset($_POST['regPass']) ? htmlspecialchars($_POST['regPass']) : ''; ?>" name="regPass"  required>
                                <i class="fa-regular fa-eye btn border-0 text-muted position-absolute end-0 top-0 pe-4 pt-4" onclick="visibility_toggle_pass()"></i> 
                                <p class="text-danger mb-0 pb-1" style="font-size: 13px;"><?php echo $passErr ?></p>
                            </div>
                            </td>
                        </tr>
                        <tr >
                            <td class="h6 pt-3 ps-5">Confirm Password</td>
                            <td class="position-relative">
                                <div class="form-input">
                                    <input id="regConPass" class="form-control mb-1" placeholder="" type="password" value="<?php echo isset($_POST['regConPass']) ? htmlspecialchars($_POST['regConPass']) : ''; ?>" name="regConPass" required>
                                    <i class="fa-regular fa-eye btn border-0 text-muted position-absolute end-0 top-0 pe-4 pt-4" onclick="visibility_toggle_conPass()"></i>
                                    <p class="text-danger mb-0 pb-1" style="font-size: 13px;"><?php echo $conPassErr ?></p>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" align="center">
                                <input id="submit" class="btn btn-secondary" type="submit" name="submitReg" value="Register">
                            </td>
                        </tr>
                        </tr class="">
                            <td colspan="2" align="center">
                            Registered already ? <a class="ps-3 link-underline link-underline-opacity-0 fw-bold" href="team_login.php">Log In</a>
                            </td>
                        </tr>
                    </table>
                        
                    </form>
            </div>
            
        </div>
        
    <div class="col-lg-1"></div>    
    </div>
    <!--form end-->
</main>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  

<!--for adding member-->
<?php include ("../action/add_team_member.php"); ?>


<!--password visibility js code-->
<script src="../js/password_visibility_toggle.js"></script>


<!--stop form resubmission-->
<script >
    if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }
</script>






<?php include("../inc/foot.php"); ?>
