<?php 
    session_start();
    include_once "config.php";

    $login_id = mysqli_real_escape_string($conn, $_POST['login_id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($login_id) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT * FROM userlogin WHERE login_id = '{$login_id}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            $enc_pass = $row['password'];
            if($user_pass === $enc_pass){
                $_SESSION['unique_id'] = $row['unique_id'];
                $_SESSION['roles'] = $row['roles'];

                if ($row['roles'] === 'Student'){
                    echo "Student";

                } else if ($row['roles'] === 'Lecturer'){
                    echo "Lecturer";

                } else if ($row['roles'] === 'Admin'){
                    echo "Admin";
                }

            }else{
                echo "UserID or Password is Incorrect!";
            }
        }else{
            echo "$login_id - This UserID not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }

?>