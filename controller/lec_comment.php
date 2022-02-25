<?php
    session_start();
    include_once "config.php";

    $student_unique_id = mysqli_real_escape_string($conn, $_POST['student_unique_id']);
    $week = mysqli_real_escape_string($conn, $_POST['week']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if(!empty($student_unique_id) &&!empty($week) && !empty($content) && !empty($comment)){

        $select_query = mysqli_query($conn, "SELECT * FROM logbook WHERE student_unique_id = '{$student_unique_id}'");

        if(mysqli_num_rows($select_query) > 0){
            $result = mysqli_fetch_assoc($select_query);

            $update_query = mysqli_query($conn, "UPDATE `logbook` SET `comment`='".$comment."' WHERE ");

            echo "Comment Successfully";

        }else{
            echo "This unique ID is not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
