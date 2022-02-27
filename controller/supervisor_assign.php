<?php
    session_start();
    include_once "config.php";

    $student_unique_id = mysqli_real_escape_string($conn, $_POST['student_unique_id']);
    $supervisor_unique_id = mysqli_real_escape_string($conn, $_POST['supervisor_unique_id']);
    $second_marker_unique_id = mysqli_real_escape_string($conn, $_POST['second_marker_unique_id']);

    if(!empty($student_unique_id) && !empty($supervisor_unique_id) && !empty($second_marker_unique_id)){

        $select_query = mysqli_query($conn, "SELECT * FROM student WHERE unique_id = '{$student_unique_id}'");

        if(mysqli_num_rows($select_query) > 0){
            $result = mysqli_fetch_assoc($select_query);

            $update_query1 = mysqli_query($conn, "UPDATE `student` SET `supervisor_unique_id`='".$supervisor_unique_id."',`second_marker_unique_id` = '{$second_marker_unique_id}'  WHERE `unique_id`='".$student_unique_id."'");

            echo "success";

        }else{
            echo "This unique ID is not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
