<?php

// Select data from the proposal table for checcking
$sql_check_submission = "SELECT * FROM proposals WHERE team_id = '$team_id'";
$result_check_submission = mysqli_query($conn, $sql_check_submission);
$check_submission = mysqli_fetch_assoc($result_check_submission);

// check proposal is approved or not
$sql_check_approval = "SELECT * FROM approved_proposals WHERE team_id = '$team_id'";
$result_check_approval = mysqli_query($conn, $sql_check_approval);
$check_approval = mysqli_fetch_assoc($result_check_approval);
   
//if the proposal is neither submitted nor approved

$proposal_submitted = false;
$proposal_approved = false;
$proposal_rejected = false;

if (mysqli_num_rows($result_check_submission)>0) {
    //if the proposal is submitted and not approved
    if($check_submission["approval_status"]=='Pending'){
        $proposal_submitted = true;
        $proposal_approved = false;
        $proposal_rejected = false;
        
        //fetch the proposal details if submitted already
        $title = $check_submission["project_title"];
        $descipline = $check_submission["descipline"];
        $year = $check_submission["year"];
        $status = $check_submission["approval_status"];
        $message = $check_submission["message"];
        //check supervisor assigned or not
        if($check_submission["assigned_supervisor"]==''){
            $supervisor = "Not assigned yet.";
        }else{
            $supervisor = $check_submission["assigned_supervisor"];
        }
        $github = $check_submission["github"];
        $proposal = $check_submission["proposal"];
    }    
    //if the proposal is submitted and rejected
    elseif($check_submission["approval_status"]=='Rejected' ){
        $proposal_submitted = true;
        $proposal_approved = false;
        $proposal_rejected = true;

        $title = $check_submission["project_title"];
        $descipline = $check_submission["descipline"];
        $year = $check_submission["year"];
        $status = $check_submission["approval_status"];
        $message = $check_submission["message"];
        //check supervisor assigned or not
        if($check_submission["assigned_supervisor"]==''){
            $supervisor = "Not assigned yet.";
        }else{
            $supervisor = $check_submission["assigned_supervisor"];
        }
        $github = $check_submission["github"];
        $proposal = $check_submission["proposal"];

    } 
    //if the proposal is submitted and approved
    elseif($check_submission["approval_status"]=='Approved'){
        $proposal_submitted = true;
        $proposal_approved = true;
        $proposal_rejected = false;

        //fetch the details if approved
        $status = "Approved";
        $title = $check_submission["project_title"];
        $descipline = $check_submission["descipline"];
        $year = $check_submission["year"];
        $message = $check_submission["message"];
        $supervisor = $check_submission["assigned_supervisor"];
        $github = $check_submission["github"];
        $proposal = $check_submission["proposal"];

    }
}
 


//if proposal not submitted already then upload
if (isset($_POST["proposal_submit"]) && !$proposal_submitted) {
    $project_title = $_POST["project_title"];
    $descipline = $_POST["descipline"];
    $year = $_POST["year"];
    $supervisor_preference = $_POST["supervisor_preference"];
    $supervisor = '';
    $github_link = $_POST["github_link"];

    //file name as path
    $file_name = "uploads/". $_FILES['file']['name'];
    //temporary name 
    $file_tmp = $_FILES['file']['tmp_name'];

    //moving file from temporary location to uploads folder
    move_uploaded_file($file_tmp,$file_name);
    
    // Insert data into the database
    $sql = "INSERT INTO proposals 
    (serial,team_id, project_title, descipline, year, supervisor_preference, assigned_supervisor, approval_status, message, github, proposal)
    VALUES ('','$team_id', '$project_title', '$descipline', '$year', '$supervisor_preference', '$supervisor', 'Pending' , '' , '$github_link', '$file_name')";
    $upload=mysqli_query($conn, $sql);
    if ($upload) {
        echo "<script>
        alert('Proposal Submitted Successfully.');
        window.location.href='proposal_submission.php';
        </script>";
        exit();  
    } else {
        echo "Something went wrong !";
    }
    
}

//resubmit proposal if rejected
if (isset($_POST["resubmit"])) {
    
    //file name as path
    $file_name = "uploads/". $_FILES['new_file']['name'];
    //temporary name 
    $file_tmp = $_FILES['new_file']['tmp_name'];

    //moving file from temporary location to uploads folder
    move_uploaded_file($file_tmp,$file_name);
    
    // Insert data into the database
    $sql = "UPDATE proposals SET proposal = '$file_name', approval_status = 'Pending',
    message = '' WHERE team_id = '$team_id' ";
    $upload=mysqli_query($conn, $sql);
    if ($upload) {
        echo "<script>
        alert('Proposal Re-submitted');
        window.location.href='proposal_submission.php';
        </script>";
        exit();  
    }
}


?>