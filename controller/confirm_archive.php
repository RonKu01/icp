<?php
    session_start();
    include_once "config.php";

    $unique_id = mysqli_real_escape_string($conn, $_POST['unique_id']);

    if(!empty($unique_id)){

        $update_query = mysqli_query($conn, "UPDATE `submission_archive` SET `status`='Archived' WHERE `student_unique_id`='".$unique_id."'");
        echo "success";

    }else{
        echo "All input fields are required!";
    }
?>
