<?php
session_start();
include_once "config.php";

$student_unique_id = mysqli_real_escape_string($conn, $_POST['student_unique_id']);
$progress_stage = mysqli_real_escape_string($conn, $_POST['progress_stage']);
$percent = mysqli_real_escape_string($conn, $_POST['percent']);

if(!empty($student_unique_id) &&!empty($progress_stage) && !empty($percent)){

        $update_query2 = mysqli_query($conn, "UPDATE `progress` SET `progress_stage`='".$progress_stage."',`percent`='".$percent."' WHERE `student_unique_id`='".$student_unique_id."'");
        echo "Update Successfully";

}else{
    echo "All input fields are required!";
}
?>
