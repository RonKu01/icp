<?php
    session_start();
    include_once "config.php";

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $week = mysqli_real_escape_string($conn, $_POST['week']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if(!empty($id) &&!empty($week) && !empty($content) && !empty($comment)){

            $update_query = mysqli_query($conn, "UPDATE `logbook` SET `comment`='".$comment."' WHERE `id` = '{$id}'");
            echo "success";

    }else{
        echo "All input fields are required!";
    }
?>
