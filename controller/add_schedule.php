<?php
session_start();
if(isset($_SESSION['unique_id'])){

    include_once "config.php";
    $fyp_type = mysqli_real_escape_string($conn, $_POST['fyp_type']);
    $week = mysqli_real_escape_string($conn, $_POST['week']);
    $task = mysqli_real_escape_string($conn, $_POST['task']);
    $remark = mysqli_real_escape_string($conn, $_POST['add_remark_submission']);

    if(!empty($week) && !empty($task) && !empty($fyp_type)){
        $sql = mysqli_query($conn, "INSERT INTO sys_dev_schedule (week, task, fyp_type, remark)
                                        VALUES ('{$week}', '{$task}', '{$fyp_type}', '{$remark}')") or die();
        if($sql){
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo 'Please enter all field!';
    }

}else{
    header("location: ../view/login.php");
}
?>