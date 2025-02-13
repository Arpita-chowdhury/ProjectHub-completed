<?php

$supervisor = $_SESSION["supervisor"];

// fetch supervisor details based on the email from supervisor table
$sql = "SELECT * FROM supervisor WHERE initial = '$supervisor'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);

$supervisor_name = $row["name"];
$supervisor_designation = $row["designation"];
$supervisor_email = $row["email"];
$supervisor_initial = $row["initial"];

?>