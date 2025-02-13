<?php
include ("../config/dbConn.php");
$remove_project = $_GET["project"];
$sql_remove = "DELETE FROM completed_projects WHERE team_id = '$remove_project' ";
$result_remove = mysqli_query($conn, $sql_remove);

if($result_remove){
    echo"<script>
    alert('Project Removed from the system.');
    window.location.href='completed_projects.php';
    </script> ";
}

?>