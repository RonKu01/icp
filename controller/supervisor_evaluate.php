<?php
    session_start();
    include_once "config.php";

    $unique_id = mysqli_real_escape_string($conn, $_POST['unique_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $programme = mysqli_real_escape_string($conn, $_POST['programme']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);
    $phone_num = mysqli_real_escape_string($conn, $_POST['phone_num']);
    $fyp_title = mysqli_real_escape_string($conn, $_POST['fyp_title']);
    $supervisor_unique_id = mysqli_real_escape_string($conn, $_POST['supervisor_unique_id']);

    if(!empty($unique_id) &&!empty($name) && !empty($email) && !empty($programme)  && !empty($year) && !empty($cgpa) && !empty($phone_num) && !empty($fyp_title) && !empty($supervisor_unique_id)){

        $select_query = mysqli_query($conn, "SELECT * FROM userlogin WHERE unique_id = '{$unique_id}'");

        if(mysqli_num_rows($select_query) > 0){
            $result = mysqli_fetch_assoc($select_query);

            $update_query1 = mysqli_query($conn, "UPDATE `student` SET `supervisor_unique_id`='".$supervisor_unique_id."' WHERE `unique_id`='".$unique_id."'");
            $update_query2 = mysqli_query($conn, "UPDATE `student` SET `email`='{$email}',`programme`='{$programme}',`year`='{$year}',`cgpa`='{$cgpa}',`phone_num`='{$phone_num}',`fyp_title`='{$fyp_title}',`supervisor_unique_id`='{$supervisor_unique_id}' WHERE `unique_id`='".$unique_id."'");

            echo "success";

        }else{
            echo "This unique ID is not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
