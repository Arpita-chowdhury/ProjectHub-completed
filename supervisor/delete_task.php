<?php
include ("../config/dbConn.php");

$task_id = $_GET["task_id"];

$sql_delete_task = "DELETE FROM tasks WHERE serial = '$task_id' ";
$result_delete_task = mysqli_query($conn,$sql_delete_task);

if($result_delete_task){
    echo "<script>
    alert('Task Deleted.');
    window.location.href='assigned_tasks.php' ;
    </script>";
    
}

?>