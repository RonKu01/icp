<?php
    session_start();
    include_once "config.php";

    $unique_id = mysqli_real_escape_string($conn, $_POST['unique_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $major = mysqli_real_escape_string($conn, $_POST['major']);
    $research = mysqli_real_escape_string($conn, $_POST['research']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($unique_id) &&!empty($name) && !empty($email) && !empty($position) && !empty($major) && !empty($research) && !empty($password)){

        $select_query = mysqli_query($conn, "SELECT * FROM userlogin WHERE unique_id = '{$unique_id}'");

        if(mysqli_num_rows($select_query) > 0){
            $result = mysqli_fetch_assoc($select_query);

            if ($password != $result['password']){
                $enc_pass = md5($password);
                $update_query1 = mysqli_query($conn, "UPDATE `userlogin` SET `password`='".$enc_pass."' WHERE `unique_id`='".$unique_id."'");
            }
            $update_query2 = mysqli_query($conn, "UPDATE `lecturer` SET `email`='".$email."',`position`='".$position."',`major`='".$major."',`research`='".$research."' WHERE `unique_id`='".$unique_id."'");

            echo "Update Successfully";

        }else{
            echo "This unique ID is not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
