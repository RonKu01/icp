<?php
session_start();
if(isset($_SESSION['unique_id'])){

    include_once "config.php";
    $student_unique_id = mysqli_real_escape_string($conn, $_POST['student_unique_id']);
    $pro_stmt = mysqli_real_escape_string($conn, $_POST['pro_stmt']);
    $pro_stmt_comment = mysqli_real_escape_string($conn, $_POST['pro_stmt_comment']);
    $lit_review = mysqli_real_escape_string($conn, $_POST['lit_review']);
    $lit_review_comment = mysqli_real_escape_string($conn, $_POST['lit_review_comment']);
    $analysis_design = mysqli_real_escape_string($conn, $_POST['analysis_design']);
    $analysis_design_comment = mysqli_real_escape_string($conn, $_POST['analysis_design_comment']);
    $imple_test = mysqli_real_escape_string($conn, $_POST['imple_test']);
    $imple_test_comment = mysqli_real_escape_string($conn, $_POST['imple_test_comment']);
    $pro_mange = mysqli_real_escape_string($conn, $_POST['pro_mange']);
    $pro_mange_comment = mysqli_real_escape_string($conn, $_POST['pro_mange_comment']);
    $conclusion = mysqli_real_escape_string($conn, $_POST['conclusion']);
    $conclusion_comment = mysqli_real_escape_string($conn, $_POST['conclusion_comment']);
    $doc_viva = mysqli_real_escape_string($conn, $_POST['doc_viva']);
    $doc_viva_comment = mysqli_real_escape_string($conn, $_POST['doc_viva_comment']);

    if(!empty($student_unique_id) && !empty($pro_stmt) && !empty($pro_stmt_comment) && !empty($lit_review) && !empty($lit_review_comment) && !empty($analysis_design) && !empty($analysis_design_comment)
        && !empty($imple_test) && !empty($imple_test_comment) && !empty($pro_mange) && !empty($pro_mange_comment) && !empty($conclusion) && !empty($conclusion_comment)  && !empty($doc_viva) && !empty($doc_viva_comment)){

        $sql = "SELECT * FROM grade WHERE student_unique_id = {$student_unique_id}";

        $result = $conn ->query($sql);
        if (!empty($result) && $result->num_rows > 0) {
           echo "Failed! This student FYP Project has already evaluated! Please check on the Grading Summary";

        } else {
            $sql = mysqli_query($conn, "INSERT INTO grade (student_unique_id, pro_stmt, pro_stmt_comment, lit_review, lit_review_comment, analysis_design, analysis_design_comment, imple_test,
                   imple_test_comment, pro_mange, pro_mange_comment, conclusion, conclusion_comment, doc_viva, doc_viva_comment)
                                        VALUES ('{$student_unique_id}', '{$pro_stmt}', '{$pro_stmt_comment}' , '{$lit_review}', '{$lit_review_comment}' , '{$analysis_design}', '{$analysis_design_comment}' , '{$imple_test}', '{$imple_test_comment}'
                                        , '{$pro_mange}', '{$pro_mange_comment}' , '{$conclusion}', '{$conclusion_comment}', '{$doc_viva}', '{$doc_viva_comment}')") or die();
            if($sql){
                echo "success";
            } else {
                echo "fail";
            }
        }
    } else {
        echo "Please fill all the required field.";
    }

}else{
    header("location: ../view/login.php");
}
?>