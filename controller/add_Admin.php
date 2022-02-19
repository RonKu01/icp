<?php
    session_start();
    include_once "config.php";

    $name = 'admin';
    $password = 'admin';

    if(!empty($name) && !empty($password)){

        $ran_id = rand(time(), 1000000000);
        $roles = "Admin";
        $encrypt_pass = md5($password);
        $login_id = $name;

        $insert_query = mysqli_query($conn, "INSERT INTO userlogin (login_id, password, roles, unique_id)
            VALUES ('{$login_id}', '{$encrypt_pass}', '{$roles}', '{$ran_id}')");

        if($insert_query){
            $insert_query2 = mysqli_query($conn, "INSERT INTO coordinator (unique_id, name)
            VALUES ('{$ran_id}', '{$name}')");

            if($insert_query2){
                $sql = mysqli_query($conn, "SELECT * FROM coordinator WHERE unique_id = '{$ran_id}'");

                if(mysqli_num_rows($sql) > 0){
                    $result = mysqli_fetch_assoc($sql);
                    echo "success";
                }else{
                    echo "This unique ID is not Exist!";
                }
            }
        }
    }else{
        echo "All input fields are required!";
    }
?>
