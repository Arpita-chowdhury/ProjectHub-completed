<?php 
session_start();
include ("../action/team_session.php");
include ("../config/dbConn.php");
include ("../action/team_login_handler.php");
include ("../action/team_details_handler.php");

$sql_completed = "SELECT * FROM completed_projects
WHERE team_id = '$team_id' AND status = 'completed'";
$result_completed = mysqli_query($conn, $sql_completed);
$completed = mysqli_fetch_assoc($result_completed);

if(isset($_POST["edit"])){
    $batch = $_POST["batch"];
    $section = $_POST["section"];
    $description = $_POST["description"];
    $file = "uploads/". $_FILES['file']['name'];

    //temporary name 
    $file_tmp = $_FILES['file']['tmp_name'];
    //moving file from temporary location to uploads folder
    move_uploaded_file($file_tmp,$file);

    $sql_edit = "UPDATE completed_projects SET batch = '$batch', section = '$section' ,
    description = '$description' , file = '$file' WHERE team_id = '$team_id' ";
    $result_edit = mysqli_query($conn, $sql_edit);

    //confirmation alert
    if($result_edit){
        echo "<script>
        alert('Saved. Thanks for Sharing your project.');
        window.location.href='edit_completed_project.php';
        </script>";
        exit(); 
    }
}

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

<main class="pb-5">
    <div class="bg-dark bg-gradient text-light py-3">
        <span class="mx-5 px-5 h5 ">Team : <?php echo $team_name ?></span>
        <span class="mx-5 px-5 h6 ">Team ID : <?php echo $team_id ?></span>
        <span class="h6 mx-5" style="" >email : <?php echo $team_email ?></span>
    </div>
    <hr class="text-light mt-0 mb-2">

    <!--page content-->
    <div class="container ">
        <div class="row">
            
            <!--sidebar start-->
            <?php include ("../inc/sidebar_user.php"); ?>
            <!--sidebar end-->

            <!---->
            <div class="col-sm-11 col-md-8 col-lg-8 mb-5" id="right_sidebar">
                <div class="bg-secondary py-1">
                    <div class="text-light text-center h5 ">Completed Project Details</div>
                    <hr class="text-light mt-0 mb-1">
                </div>

                <div class="px-5 mt-3 text-light">
                    <?php if(isset($completed["section"])){ ?>
                        <table class="table table-borderless table-dark">
                        <tr >
                            <td class="ps-3">Batch</td>
                            <td><?php echo $completed["batch"] ?></td>
                        </tr>
                        <tr>
                            <td class="ps-3">Section</td>
                            <td><?php echo $completed["section"] ?></td>
                        </tr>
                        <tr>
                            <td class="ps-3">Project title</td>
                            <td><?php echo $completed["project_title"] ?></td>
                        </tr>
                        <tr>
                            <td class="ps-3">Descipline</td>
                            <td ><?php echo $completed["descipline"] ?></td>
                        </tr>
                        <tr>
                            <td class="ps-3">Supervisor</td>
                            <td><?php echo $completed["supervisor"] ?></td>
                        </tr>
                        <tr >
                            <td class="ps-3">Github Link</td>
                            <td><a href="<?php echo $completed["github"] ?>">github</a></td>
                        </tr>
                        <tr >
                            <td class="ps-3">Description</td>
                            <td><?php echo $completed["description"] ?></td>
                        </tr>
                        <tr>
                            <td class="ps-3">File</td>
                            <td><a href="<?php echo $completed["file"] ?>">file</a></td>
                        </tr>
                        </table>
                    <?php }else{ ?>
                    <form class="" name=""  action="" method="post" enctype="multipart/form-data">
                        <table class="table table-borderless table-dark">
                            <tr >
                                <td class="ps-3">Batch</td>
                                <td><input class="form-control bg-dark text-light" type="text" name="batch"></td>
                            </tr>
                            <tr>
                                <td class="ps-3">Section</td>
                                <td><input class="form-control bg-dark text-light" type="text" name="section"></td>
                            </tr>
                            <tr>
                                <td class="ps-3">Project title</td>
                                <td><?php echo $completed["project_title"] ?></td>
                            </tr>
                            <tr>
                                <td class="ps-3">Descipline</td>
                                <td ><?php echo $completed["descipline"] ?></td>
                            </tr>
                            <tr>
                                <td class="ps-3">Supervisor</td>
                                <td><?php echo $completed["supervisor"] ?></td>
                            </tr>
                            <tr >
                                <td class="ps-3">Github Link</td>
                                <td><a href="<?php echo $completed["github"] ?>">github</a></td>
                            </tr>
                            <tr >
                                <td class="ps-3">Description</td>
                                <td>
                                    <p class="form-text text-secondary">Add a short description about your project and it's features.</p>
                                    <textarea class="form-control bg-dark text-light" name="description"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">File</td>
                                <td>
                                    <p class="form-text text-secondary">Project report or any file related to the project.</p>
                                    <input class="form-control bg-dark text-light" type="file" name="file"></td>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <button class="btn btn-secondary" type="submit" name="edit">Save</button>
                                </td>
                            </tr>
                        </table>
                             
                    </form>
                   <?php } ?>
                
                </div>
                
                
            </div>

            
        </div>
        
        
        </div>
        

    </div>
</main>
    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include("../action/form_resubmission_handler.php") ?>
    <?php include("../inc/foot.php") ?>
</body>

</html>