<?php
session_start();
if(isset($_SESSION['unique_id'])){

    include_once "config.php";
    $fyp_type = mysqli_real_escape_string($conn, $_POST['fyp_type']);
    $week = mysqli_real_escape_string($conn, $_POST['week']);
    $task = mysqli_real_escape_string($conn, $_POST['task']);

    if(!empty($week)){
        $sql = mysqli_query($conn, "INSERT INTO sys_dev_schedule (week, task, fyp_type)
                                        VALUES ('{$week}', '{$task}', '{$fyp_type}')") or die();
        if($sql){
            echo "success";
        } else {
            echo "fail";
        }
    }

}else{
    header("location: ../view/login.php");
}
?>