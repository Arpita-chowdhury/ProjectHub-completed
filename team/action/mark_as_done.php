<?php
include ("../../config/dbConn.php");

$meeting = $_GET["meeting"];

$sql_mark_as_done = "DELETE FROM meetings WHERE serial = '$meeting'";
$result_mark_as_done = mysqli_query($conn, $sql_mark_as_done);

if($result_mark_as_done){
    echo"<script>
    alert('Meeting is Marked as Done.');
    window.location.href='../request_meeting.php';
    </script> ";
}

?>