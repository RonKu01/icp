<?php
    session_start();
    include_once "config.php";
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $programme = mysqli_real_escape_string($conn, $_POST['programme']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);
    $phone_num = mysqli_real_escape_string($conn, $_POST['phone_num']);
    $fyp_title = mysqli_real_escape_string($conn, $_POST['fyp_title']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($name) && !empty($email) && !empty($programme) && !empty($year)&& !empty($cgpa) && !empty($phone_num)&& !empty($fyp_title) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM student WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exist!";
            }else{

                $ran_id = rand(time(), 10000);
                $roles = "Student";
                $encrypt_pass = md5($password);
                $login_id = 'ST_'. $name;

                $insert_query = mysqli_query($conn, "INSERT INTO userlogin (login_id, password, roles, unique_id)
                VALUES ('{$login_id}', '{$encrypt_pass}', '{$roles}', '{$ran_id}')");

                if($insert_query){
                  $insert_query2 = mysqli_query($conn, "INSERT INTO student (unique_id, name, email, programme, year, cgpa, phone_num, fyp_title)
                  VALUES ('{$ran_id}', '{$name}', '{$email}', '{$programme}', '{$year}', '{$cgpa}', '{$phone_num}', '{$fyp_title}')");

                  echo "success";
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
