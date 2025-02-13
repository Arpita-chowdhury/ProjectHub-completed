<?php
//update task progress if in progress
if(isset($_POST["update"])){
    if($_POST["progress"] == 'In-progress'){
        $progress = 'In-progress';
    
        $sql_update = "UPDATE tasks SET 
        progress = '$progress'
        WHERE serial = '$task_id' ";
        $result_update = mysqli_query($conn,$sql_update);

        if($result_update){
            echo"<script>
            alert('Task status updated .');
            window.location.href='all_tasks.php';
            </script>";
        }
    }   
}

//update task progress if completed
if(isset($_POST["upload"])){
    $progress = 'Completed';
    $message = $_POST["message"];
    
    //screenshot file
    $screenshot = "uploads/". $_FILES['screenshot']['name']; //file name as path
    $screenshot_tmp = $_FILES['screenshot']['tmp_name']; //temporary name
    move_uploaded_file($screenshot_tmp,$screenshot); //moving file from temporary location to uploads folder
    
    //screen record file
    $screen_record = "uploads/". $_FILES['screen_record']['name']; //file name as path
    $screen_record_tmp = $_FILES['screen_record']['tmp_name']; //temporary name
    move_uploaded_file($screen_record_tmp,$screen_record); //moving file from temporary location to uploads folder

    if(empty($message) || empty($screenshot) || empty($screen_record)){
        echo"<script>
        alert('You have to provide the mentioned files!');
        </script>";
    }else{
        $sql_update = "UPDATE tasks SET
        progress = '$progress', 
        screenshot = '$screenshot',
        video = '$screen_record',
        message = '$message' WHERE serial = '$task_id' ";
        $result_update = mysqli_query($conn,$sql_update);
    }

    if($result_update){
        echo"<script>
        alert('Task status updated.');
        window.location.href='all_tasks.php';
        </script>";
    }
} 
?>