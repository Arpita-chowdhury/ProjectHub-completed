<?php
//mark a meeting as done
if(isset($_POST["done"])){
    $meeting = $_POST["done"];
    $sql_select_meeting = "SELECT * FROM meetings WHERE serial = '$meeting' ";
    $result_select_meeting = mysqli_query($conn, $sql_select_meeting);
    $select_meeting = mysqli_fetch_array($result_select_meeting);

    //if meeting is scheduled and done
    if($select_meeting["status"] == "scheduled"){
        $current_date = date("Y-m-d");
        $formated_current_date = date("d/m/Y", strtotime($current_date));

        if($select_meeting["date"] < $formated_current_date){
            $sql_mark_as_done = "DELETE FROM meetings WHERE serial = '$meeting'";
            $result_mark_as_done = mysqli_query($conn, $sql_mark_as_done);

            if($result_mark_as_done){
                echo"<script>
                alert('Meeting is Marked as Done.');
                window.location.href='request_meeting.php';
                </script> ";
            }
        }else{
            echo"<script>
                alert('Schedule for this Meeting is not exceeded yet!');
                window.location.href='request_meeting.php';
                </script> ";
        }
    }elseif($select_meeting["status"] == "pending"){
        echo "<script>
        var result = confirm('This meeting request is pending. Still want to mark as Done?');
            if (result == true) {
                window.location.href = 'action/mark_as_done.php?meeting=$meeting';
            } else {
                window.location.href='request_meeting.php';
            }
        </script>";
    }elseif($select_meeting["status"] == "rejected"){
        echo"<script>
            alert('This Meeting can only be marked as Done by your Supervisor.');
            window.location.href='request_meeting.php';
            </script> ";
    } 
    
}

?>