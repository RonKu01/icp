<?php
session_start();
include_once "config.php";

$student_unique_id = mysqli_real_escape_string($conn, $_POST['student_unique_id']);

if(isset($_FILES['file'])) {
    $img_name = $_FILES['file']['name'];
    $img_type = $_FILES['file']['type'];
    $tmp_name = $_FILES['file']['tmp_name'];

    $img_explode = explode('.',$img_name);
    $img_ext = end($img_explode);

    $extensions = ["pdf"];

    if(in_array($img_ext, $extensions) === true){

        $types = ["application/pdf"];

        if(in_array($img_type, $types) === true) {

            if(move_uploaded_file($tmp_name, "../assets/fyp/".$img_name)){

                $insert_query = mysqli_query($conn, "INSERT INTO archive (student_unique_id, filesName) VALUES ('{$student_unique_id}', '{$img_name}')");

                if($insert_query){
                    $select_sql = mysqli_query($conn, "SELECT * FROM archive WHERE student_unique_id= '{$student_unique_id}' AND filesName = '{$img_name}'");
                    if(mysqli_num_rows($select_sql) > 0){
                        echo "success";
                    }else{
                        echo "This File is not Exist!";
                    }
                } else{
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "Fail. Try again later.";
            }
        } else {
            echo "Please upload a PDF file.";
        }
    } else {
        echo "All input fields are required!";
    }


}