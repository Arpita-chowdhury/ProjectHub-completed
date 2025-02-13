<?php

//approved
$sql_approved_tasks = "SELECT * FROM tasks
WHERE team_id = '$team_id' AND progress = 'Approved' ";
$result_approved_tasks = mysqli_query($conn,$sql_approved_tasks);
$approved_tasks = mysqli_fetch_all($result_approved_tasks, MYSQLI_ASSOC);

//completed
$sql_completed_tasks = "SELECT * FROM tasks
WHERE team_id = '$team_id' AND progress = 'Completed' ";
$result_completed_tasks = mysqli_query($conn,$sql_completed_tasks);
$completed_tasks = mysqli_fetch_all($result_completed_tasks, MYSQLI_ASSOC);

//in-progress
$sql_in_progress_tasks = "SELECT * FROM tasks
WHERE team_id = '$team_id' AND progress = 'In-progress' ";
$result_in_progress_tasks = mysqli_query($conn,$sql_in_progress_tasks);
$in_progress_tasks = mysqli_fetch_all($result_in_progress_tasks, MYSQLI_ASSOC);

//remaining
$sql_remaining_tasks = "SELECT * FROM tasks
WHERE team_id = '$team_id' AND progress = 'Not Started' ";
$result_remaining_tasks = mysqli_query($conn,$sql_remaining_tasks);
$remaining_tasks = mysqli_fetch_all($result_remaining_tasks, MYSQLI_ASSOC);

//rejected
$sql_rejected_tasks = "SELECT * FROM tasks
WHERE team_id = '$team_id' AND progress = 'Rejected' ";
$result_rejected_tasks = mysqli_query($conn,$sql_rejected_tasks);
$rejected_tasks = mysqli_fetch_all($result_rejected_tasks, MYSQLI_ASSOC);

?>