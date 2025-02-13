<?php
session_start();
include ("../config/dbConn.php");

// Check if the user is logged in
if (!isset($_SESSION["team"])) {
    header("Location: ../team/team_login.php"); // Redirect to login page if not logged in
    exit();
}else{
    $team_id = $_SESSION["team"];
}
include ("../action/team_login_handler.php");
include ("../action/team_details_handler.php");

if(isset($_POST["upload_project"])){
    $batch = $_POST["batch"];
    $section = $_POST["section"];
    $project_title = $_POST["project_title"];
    $descipline = $_POST["descipline"];
    $supervisor = $_POST["supervisor"];
    $description = $_POST["description"];
    $github = $_POST["github"];

    //file name as path
    $file = "uploads/". $_FILES['file']['name'];
    //temporary name 
    $file_tmp = $_FILES['file']['tmp_name'];
    //moving file from temporary location to uploads folder
    move_uploaded_file($file_tmp,$file);

    $experience = $_POST["experience"];
    $status = '';

    //upload the project to completed projects table and needs to be approved by supervisor and admin for showcase
    $sql_upload = "INSERT INTO completed_projects (serial,team_id, batch, section, project_title, descipline, supervisor, description, github, file, experience, status)
    VALUES ('', $team_id, '$batch' , '$section' , '$project_title' , '$descipline' , '$supervisor' , '$description' , '$github' , '$file' , '$experience', 'pending' ) ";
    $result_upload = mysqli_query($conn, $sql_upload);

    //confirmation alert
    if($result_upload){
        echo "<script>
        alert('Thanks for Sharing your project. Your project will be available for showcase after approval of your supervisor .');
        window.location.href='previous_projects.php';
        </script>";
        exit(); 
    }else{
        echo "Something went wrong!" ;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<?php include("../inc/head.php"); ?>
<body class="bg-dark text-light">
    <div class="container">
        <!--body container start-->
        <!--navbar starts here-->
        <header>
            <nav class="navbar navbar-expand-sm sticky-top bg-secondary px-2">
                <!--logo design-->
                <a class="navbar-brand d-flex text-capitalize" href="../index.php" >
                <?php include("../inc/logo.php"); ?>
                </a>
                <!--logo design-->
                <!--navbar collapse button for small screen-->
                <?php include("../inc/nav_collapse.php"); ?>

                <!--navbar links-->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto ">
                        <?php if(isset($_SESSION["team"])){ ?>
                            <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="../index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                            <li class="nav-item me-2" data-toggle="tooltip" data-placement="top" title="Team profile"><a class="nav-link text-light" href="../team/team_dashboard.php"><i class="p-1 fa-solid fa-user border rounded-circle"></i></a></li>
                            <li class="nav-item" ><a class="nav-link text-light my-sidebar-style" href="../action/logout.php">Log out</a></li>
                        <?php }else{ ?>
                            <li class="nav-item me-1" data-toggle="tooltip" data-placement="top" title="Homepage"><a class="nav-link text-light" href="../index.php"><i class="p-1 fa-solid fa-house " ></i></a></li>
                            <li class="nav-item "><a class="nav-link text-light" href="../login.php">Log In</a></li>
                            <li class="nav-item" ><a class="nav-link text-light" href="../team/team_registration.php">Register</a></li>
                        <?php } ?>
                    </ul>
                </div>
                
            </nav>
        </header>
        <!--navbar ends here-->

        <main>
            <!--project upload section-->
            
            <!--upload form start-->
            <div class="container">
                <div class="row">

                    <!--banner-->
                    <div class="col-6 px-4 ">
                        <div class="content my-5 py-5 ">
                            <div class="display-4 m-2 text-center">
                            Contribute to the <span class="text-secondary">ProjectHub</span> Inspiration Corner<br>
                            </div>
                            <div class="mt-5 text-center">
                                <em><p class="lead">Share Your Completed Projects here to Support Fellow Students..<br>
                                </p></em>
                                <p class="lead pt-4 text-center">Let's Collaborate and Help Each Other Grow!</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-6 rounded shadow px-4 mt-4 border border-secondary">
                        <div class="">
                            <div class="h4 m-2 text-center py-2">Upload A project
                                <hr class="my-1">
                            </div>
                        </div>
                        <!--project upload form-->
                        <form class="" name=""  action="" method="post" enctype="multipart/form-data">
                            <table class="table table-borderless table-dark ">
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
                                    <td><input class="form-control bg-dark text-light" type="text" name="project_title"></td>
                                </tr>
                                <tr>
                                    <td class="ps-3">Descipline</td>
                                    <td >
                                        <input class="form-check-input ms-3" type="radio" id="android" value="android" name="descipline"><label class="form-label me-4 ps-2" for="android">Android</label>
                                        <input class="form-check-input" type="radio" id="web" value="web" name="descipline"><label class="form-label me-4 ps-2" for="web">Web</label>
                                        <input class="form-check-input" type="radio" id="others" value="others" name="descipline"><label class="form-label me-4 ps-2" for="others">Others</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-3">Supervisor</td>
                                    <td>
                                        <select class="form-select bg-dark text-light" name="supervisor">
                                        <option selected></option>
                                        <?php 
                                        $sql_supervisor = "SELECT * FROM supervisor";
                                        $result_supervisor = mysqli_query($conn,$sql_supervisor);
                                        while($supervisor = mysqli_fetch_assoc($result_supervisor)){ ?>
                                            <option value="<?php echo $supervisor["initial"]; ?>" ><?php echo $supervisor["name"]; ?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr >
                                    <td class="ps-3">Description</td>
                                    <td>
                                        <small><p class="form-text text-secondary mb-0">Add a short description about your project and it's features.</p>
                                        </small>
                                        <textarea class="form-control bg-dark text-light" name="description"></textarea>
                                    </td>
                                </tr>
                                <tr >
                                    <td class="ps-3">Github Link</td>
                                    <td>
                                        <small><p class="form-text text-secondary mb-0">Add the github repository link if you want.</p>
                                        </small>
                                        <input class="form-control bg-dark text-light" type="link" name="github"></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-3">File</td>
                                    <td>
                                        <small><p class="form-text text-secondary mb-0">Project report or any file related to the project.</p>
                                        </small>
                                        <input class="form-control bg-dark text-light" type="file" name="file"></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-3 ">Your expeience</td>
                                    <td>
                                        <small><p class="form-text text-secondary mb-0">Share your teams experience about this project.</p>
                                        </small>
                                        <textarea class="form-control bg-dark text-light" name="experience"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <button class="btn btn-secondary" type="submit" name="upload_project">Upload</button>
                                    </td>
                                </tr>
                            </table>
                             
                         </form>
                    </div>

                    
                </div>
                
                
            </div>
            <!--upload form end-->
        </main>


        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include("../action/form_resubmission_handler.php") ?>
    <?php include("../inc/foot.php") ?>
</body>

</html>