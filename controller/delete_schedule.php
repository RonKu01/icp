<?php
    session_start();
    include_once "config.php";

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $dlt_query = mysqli_query($conn, "DELETE FROM `sys_dev_schedule` WHERE `id` = '".$id."'");
    echo "success";

?>
