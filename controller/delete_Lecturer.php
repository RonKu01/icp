<?php
    session_start();
    include_once "config.php";

    $unique_id = mysqli_real_escape_string($conn, $_POST['unique_id']);

    if(!empty($unique_id)){
        $dlt_query = mysqli_query($conn, "DELETE  FROM `userlogin` WHERE `unique_id` = '".$unique_id."'");
        $dlt_query = mysqli_query($conn, "DELETE  FROM `lecturer` WHERE `unique_id` = '".$unique_id."'");

        echo "success";

    }else{
        echo "All input fields are required!";
    }
?>
