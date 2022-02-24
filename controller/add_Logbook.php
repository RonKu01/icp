<?php
    session_start();
    include_once "config.php";

    $student_unique_id = mysqli_real_escape_string($conn, $_POST['student_unique_id']);
    $week = mysqli_real_escape_string($conn, $_POST['week']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);


    if(!empty($student_unique_id) && !empty($week) && !empty($content)){
        $insert_query = mysqli_query($conn, "INSERT INTO logbook (student_unique_id, week, content) VALUES ('{$student_unique_id}', '{$week}', '{$content}')");
        echo "success";

    }else{
        echo "All input fields are required!";
    }
?>
