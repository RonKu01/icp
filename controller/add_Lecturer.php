<?php
    session_start();
    include_once "config.php";
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $major = mysqli_real_escape_string($conn, $_POST['major']);
    $research = mysqli_real_escape_string($conn, $_POST['research']);
    $interest = mysqli_real_escape_string($conn, $_POST['interest']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($name) && !empty($email) && !empty($position) && !empty($major) && !empty($research) && !empty($interest) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM lecturer WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exist!";
            }else{

                $ran_id = rand(time(), 1000000000);
                $roles = "Lecturer";
                $encrypt_pass = md5($password);
                $login_id = $name;

                $insert_query = mysqli_query($conn, "INSERT INTO userlogin (login_id, password, roles, unique_id)
                VALUES ('{$login_id}', '{$encrypt_pass}', '{$roles}', '{$ran_id}')");

                if($insert_query){
                  $insert_query2 = mysqli_query($conn, "INSERT INTO lecturer (unique_id, name, email, position, major, research, interest)
                  VALUES ('{$ran_id}', '{$name}', '{$email}', '{$position}', '{$major}', '{$research}', '{$interest}')");

                  if($insert_query2){
                      $sql = mysqli_query($conn, "SELECT * FROM lecturer WHERE unique_id = '{$ran_id}'");

                      if(mysqli_num_rows($sql) > 0){
                          $result = mysqli_fetch_assoc($sql);
                          $_SESSION['unique_id'] = $result['unique_id'];
                          echo "success";
                      }else{
                          echo "This unique ID is not Exist!";
                      }
                  }
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
