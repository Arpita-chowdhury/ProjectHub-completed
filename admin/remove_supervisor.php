<?php
include ("../config/dbConn.php");
$remove_supervisor = $_GET["supervisor"];
$sql_remove = "DELETE FROM supervisor WHERE initial = '$remove_supervisor' ";
$result_remove = mysqli_query($conn, $sql_remove);

if($result_remove){
    echo"<script>
    alert('Supervisor Removed from the system.');
    window.location.href='all_supervisor.php';
    </script> ";
}

?>