<?php
$team_id = $_SESSION["team"];

// fetch team members details based on the Team ID from user table
$sql = "SELECT * FROM user WHERE team_id = '$team_id'";
$result = mysqli_query($conn, $sql);

// fetch team details based on the Team ID from team table
$sql1 = "SELECT * FROM team WHERE team_id = '$team_id'";
$result1 = mysqli_query($conn, $sql1);
$row=mysqli_fetch_array($result1);
$team_name = $row["team_name"];
$team_email = $row["team_email"];
?>