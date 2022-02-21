<?php
    session_start();
    include_once "config.php";

    $student_unique_id = mysqli_real_escape_string($conn, $_POST['student_unique_id']);
    $supervisor_unique_id = mysqli_real_escape_string($conn, $_POST['supervisor_unique_id']);
    $progress_stage = mysqli_real_escape_string($conn, $_POST['progress_stage']);
    $proposal_due = mysqli_real_escape_string($conn, $_POST['proposal_due']);
    $final_due = mysqli_real_escape_string($conn, $_POST['final_due']);

    if(!empty($student_unique_id) &&!empty($supervisor_unique_id) && !empty($progress_stage) && !empty($proposal_due) && !empty($final_due)){

        $select_query = mysqli_query($conn, "SELECT * FROM progress WHERE student_unique_id = '{$student_unique_id}'");

        if(mysqli_num_rows($select_query) > 0){
            $result = mysqli_fetch_assoc($select_query);

            $update_query1 = mysqli_query($conn, "UPDATE `student` SET `supervisor_unique_id`='".$supervisor_unique_id."' WHERE `unique_id`='".$student_unique_id."'");
            $update_query2 = mysqli_query($conn, "UPDATE `progress` SET `lecturer_unique_id`='{$supervisor_unique_id}',`progress_stage`='{$progress_stage}',`proposal_due`='{$proposal_due}',`final_due`='{$final_due}' WHERE `student_unique_id` = '{$student_unique_id}'");

            echo "success";

        }else{
            echo "This unique ID is not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
