<?php
session_start();
if(isset($_SESSION['unique_id'])){

    include_once "config.php";
    $student_unique_id = mysqli_real_escape_string($conn, $_POST['student_unique_id']);
    $sec_marker_comment = mysqli_real_escape_string($conn, $_POST['second_marker_comment']);

    if(!empty($student_unique_id) && !empty($sec_marker_comment)){

        $update_query2 = mysqli_query($conn, "UPDATE `grade` SET `sec_marker_comment`='".$sec_marker_comment."' WHERE `student_unique_id`='".$student_unique_id."'");

        if($update_query2){
            echo "success";
        } else {
            echo "fail";
        }

    } else {
        echo "Please fill all the required field.";
    }

}else{
    header("location: ../view/login.php");
}
?>