<?php
session_start();
include_once "config.php";

$id = mysqli_real_escape_string($conn, $_POST['id']);
$week = mysqli_real_escape_string($conn, $_POST['week']);
$task = mysqli_real_escape_string($conn, $_POST['task']);
$remark = mysqli_real_escape_string($conn, $_POST['edit_remark_submission']);

if(!empty($week)){

        $update_query2 = mysqli_query($conn, "UPDATE `sys_dev_schedule` SET `task`='".$task."', `remark`='{$remark}' WHERE `id`='".$id."'");
        echo "success";

}else{
    echo "All input fields are required!";
}
?>
