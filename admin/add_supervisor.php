<?php 
session_start();
include ("../config/dbConn.php");
include ("../action/admin_login_handler.php");
include("../action/add_supervisor_handler.php");

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
                    <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../action/logout.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </header>
<!--navbar ends here-->


<main>
    <!--admin section-->
    <div class="">
        <div class="h3 text-light mt-3 ms-5 ps-5">Admin</div>
    </div>
    <hr class="text-light">
    <!--page content-->
    <div class="container ">
        <div class="row mb-4 ">
            
            <!--sidebar start-->
            <?php include ("admin_sidebar.php"); ?>
            <!--sidebar end-->
            

            <!---right sidebar-->
            <!--supervisor dashboard section-->
            <div class="col-sm-11 col-md-8 col-lg-8 ">

                <div class="">
                    <div class="text-light text-center h4">Add Supervisor</div>
                </div>
                
                <!--details-->
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <hr class="text-light">
                    <form class="form" name=""  action="" method="post">
                        <table class="table table-borderless table-dark">
                            <tr>
                                <td class="h6">Name</td>
                                <td><input class="form-control bg-dark text-light" type="text" name="name"></td>
                            </tr>
                            <tr>
                                <td class="h6">Initial</td>
                                <td><input class="form-control text-uppercase bg-dark text-light" type="text" name="initial"></td>
                            </tr>
                            <tr >
                                <td class="h6">Designation</td>
                                <td><input class="form-control bg-dark text-light" type="text" name="designation"></td>
                            </tr>
                            <tr >
                                <td class="h6">Email</td>
                                <td><input class="form-control bg-dark text-light" type="email" name="email"></td>
                            </tr>
                            <tr >
                                <td class="h6">Password</td>
                                <td><input class="form-control bg-dark text-light" type="password" name="password"></td>
                            </tr>
                            <tr >
                                <td colspan="2" align="center">
                                    <button class="btn btn-light" type="submit" name="add_supervisor">Add</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    </div>
                    
                    <div class="col-2"></div>
                </div>
                <!--details end-->
         
                
            </div>

            
        </div>
        
        
        </div>
        

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

<?php include("../inc/foot.php"); ?>
</body>

</html>