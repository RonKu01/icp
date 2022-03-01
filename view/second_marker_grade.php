<?php
session_start();
require_once "../controller/config.php";

if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}

if(!isset($_GET['student_unique_id'])){
    header("location: list_supervisee.php");
} else{
    $studentid = $_GET['student_unique_id'];
}


    $sql = "SELECT * FROM grade WHERE student_unique_id = {$studentid}";

    $result = $conn ->query($sql);
    if (!empty($result) && $result->num_rows > 0) {
        $row  = mysqli_fetch_assoc($result);

        $pro_stmt = $row['pro_stmt'];
        $pro_stmt_comment = $row['pro_stmt_comment'];
        $lit_review = $row['lit_review'];
        $lit_review_comment = $row['lit_review_comment'];
        $analysis_design = $row['analysis_design'];
        $analysis_design_comment = $row['analysis_design_comment'];
        $imple_test = $row['imple_test'];
        $imple_test_comment = $row['imple_test_comment'];
        $pro_mange = $row['pro_mange'];
        $pro_mange_comment = $row['pro_mange_comment'];
        $conclusion = $row['conclusion'];
        $conclusion_comment = $row['conclusion_comment'];
        $doc_viva = $row['doc_viva'];
        $doc_viva_comment = $row['doc_viva_comment'];

        $final_pro_stmt = $pro_stmt * 0.5;
        $final_lit_review = $lit_review * 1;
        $final_analysis_design = $analysis_design * 1;
        $final_imple_test = $imple_test * 1;
        $final_pro_mange = $pro_mange * 0.5;
        $final_conclusion = $conclusion * 0.5;
        $final_doc_viva = $doc_viva * 0.5;

        $final_Mark = $final_pro_stmt + $final_lit_review + $final_analysis_design + $final_imple_test + $final_pro_mange + $final_conclusion + $doc_viva;

    } else {
        echo '<script>window.alert("This student FYP Project has not been evaluate!")</script>';
        echo '<script>window.location.href = "list_supervisee.php";</script>';
    }
?>

<?php include_once "header.php"; ?>

<style>
    div.error-text{
        color: #721c24;
        padding: 8px 10px;
        text-align: center;
        border-radius: 5px;
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        margin-bottom: 10px;
        display: none;
    }
</style>

<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">ICP Assignment</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <label class="form-control form-control-dark w-100" style="text-align: center"><?php echo $_SESSION['roles']; ?></label>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="../controller/logout.php?logout_id=<?php echo $_SESSION['unique_id']; ?> ">Sign out</a>
        </div>
    </div>
</header>

<div class="container-fluid" >
    <div class="row">
        <?php
        if ($_SESSION['roles'] == "Admin")
        {
            require_once "nav_admin.php";
        }
        else if ($_SESSION['roles'] == "Lecturer")
        {
            require_once "nav_lecturer.php";
        }
        else if ($_SESSION['roles'] == "Student")
        {
            require_once "nav_student.php";
        }
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="py-3 px-2">
                <div class="container-xl">

                    <?php
                        $sql = "SELECT * FROM student WHERE unique_id = {$studentid}";

                        $id='';
                        $unique_id ='';
                        $name='';
                        $programme ='';
                        $year='';
                        $fyp_title ='';
                        $supervisor_id ='';
                        $second_marker_id ='';

                        $result = $conn ->query($sql);
                        if (!empty($result) && $result->num_rows > 0) {
                            $row  = mysqli_fetch_assoc($result);

                            $id = $row['id'];
                            $unique_id = $row['unique_id'];
                            $name = $row['name'];
                            $programme = $row['programme'];
                            $year = $row['year'];
                            $fyp_title = $row['fyp_title'];
                            $supervisor_id = $row['supervisor_unique_id'];
                            $second_marker_id = $row['second_marker_unique_id'];
                        }
                    ?>

                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>Grading</h5>
                                    </div>
                                </div>
                            </div>
                            <form class="needs-validation" id="second_marker_form" novalidate>
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <label for="name" class="form-label">Student Name</label>
                                        <input type="text" class="form-control" id="name" value="<?php echo $name ?>" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="student_unique_id" class="form-label">Student ID</label>
                                        <input type="text" class="form-control" id="student_unique_id" name="student_unique_id" value="<?php echo $unique_id ?>" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="year" class="form-label">Year</label>
                                        <input type="number" class="form-control" id="year" name="year" value="<?php echo $year?>" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="programme" class="form-label">Programme</label>
                                        <input type="text" class="form-control" id="programme" name="programme" value="<?php echo $programme?>" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="$fyp_title" class="form-label">FYP title</label>
                                        <input type="text" class="form-control" id="$fyp_title" name="$fyp_title" value="<?php echo $fyp_title?>" readonly>
                                    </div>
                                    <?php
                                    $supervisor_name ='';
                                        $sql2 = "SELECT * FROM `lecturer` WHERE unique_id = '".$supervisor_id."'" ;
                                        $result2 = $conn -> query($sql2);
                                        for ($i = 0; $i < mysqli_num_rows($result2); $i++) {
                                            $row2 = mysqli_fetch_assoc($result2);

                                            $supervisor_name = $row2['name'];
                                        }

                                        $second_marker_name ='';
                                        $sql3 = "SELECT * FROM `lecturer` WHERE unique_id = '".$second_marker_id."'" ;
                                        $result3 = $conn -> query($sql3);
                                        for ($i = 0; $i < mysqli_num_rows($result3); $i++) {
                                            $row3 = mysqli_fetch_assoc($result3);
                                            $second_marker_name = $row3['name'];
                                        }
                                    ?>
                                    <div class="col-12">
                                        <label for="supervisor_name" class="form-label">Supervisor Name</label>
                                        <input type="text" class="form-control" id="supervisor_name" name="supervisor_name" value="<?php echo $supervisor_name?>" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="second_marker" class="form-label">Second Marker</label>
                                        <input type="text" class="form-control" id="second_marker" name="second_marker" value="<?php echo $second_marker_name?>" readonly>
                                    </div>
                                </div>
                                <hr/>

                                <table class="table table-striped table-bordered table-hover w-auto">
                                    <thead>
                                        <tr>
                                        <th>Assessment Element</th>
                                        <th>Weightage</th>
                                        <th>Mark</th>
                                        <th>Weighted Mark (100%)</th>
                                        <th>Supervisor's Comment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ToR: Problem statement & relevance</td>
                                            <td style="text-align:center">0.5</td>
                                            <td style="text-align:center"><?php echo $pro_stmt ?></td>
                                            <td style="text-align:center"><?php echo $final_pro_stmt ?></td>
                                            <td style="text-align:center"><?php echo $pro_stmt_comment ?></td>
                                        </tr>
                                        <tr>
                                            <td>Literature review and research methods and
                                                findings</td>
                                            <td style="text-align:center">1</td>
                                            <td style="text-align:center"><?php echo $lit_review ?></td>
                                            <td style="text-align:center"><?php echo $final_lit_review ?></td>
                                            <td style="text-align:center"><?php echo $lit_review_comment ?></td>
                                        </tr>
                                        <tr>
                                            <td>Analysis and design</td>
                                            <td style="text-align:center">1</td>
                                            <td style="text-align:center"><?php echo $analysis_design ?></td>
                                            <td style="text-align:center"><?php echo $final_analysis_design ?></td>
                                            <td style="text-align:center"><?php echo $analysis_design_comment ?></td>
                                        </tr>
                                        <tr>
                                            <td>Implementation and testing</td>
                                            <td style="text-align:center">1</td>
                                            <td style="text-align:center"><?php echo $imple_test ?></td>
                                            <td style="text-align:center"><?php echo $final_imple_test ?></td>
                                            <td style="text-align:center"><?php echo $imple_test_comment ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project management</td>
                                            <td style="text-align:center">0.5</td>
                                            <td style="text-align:center"><?php echo $pro_mange ?></td>
                                            <td style="text-align:center"><?php echo $final_pro_mange ?></td>
                                            <td style="text-align:center"><?php echo $pro_mange_comment ?></td>
                                        </tr>
                                        <tr>
                                            <td>Conclusion, product / process evaluation and
                                                recommendation</td>
                                            <td style="text-align:center">0.5</td>
                                            <td style="text-align:center"><?php echo $conclusion ?></td>
                                            <td style="text-align:center"><?php echo $final_conclusion ?></td>
                                            <td style="text-align:center"><?php echo $conclusion_comment ?></td>
                                        </tr>
                                        <tr>
                                            <td>Documentation and viva</td>
                                            <td style="text-align:center">0.5</td>
                                            <td style="text-align:center"><?php echo $doc_viva ?></td>
                                            <td style="text-align:center"><?php echo $final_doc_viva ?></td>
                                            <td style="text-align:center"><?php echo $doc_viva_comment ?></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Total Mark - Report</td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align:center"><?php echo $final_Mark ?> </td>
                                            <td></td>
                                    </tfoot>
                                </table>

                                <hr class="my-4">

                                <label class="form-label" for="second_marker_comment">Second Marker's Comment</label>
                                <textarea class="form-control" id="second_marker_comment" name="second_marker_comment" rows="5"></textarea>

                                <hr class="my-4">

                                <div class="error-text" id="error_text"></div>
                                <button class="w-100 btn btn-primary btn-lg" id="btnSubmit" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="../assets/javascript/add_second_marker_comment.js"></script>

<script src="../assets/javascript/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../assets/javascript/dashboard.js"></script>

<script>
    $(document).ready(function(){
        // NavBar Active
        $('a.active').removeClass('active');
        var url = window.location.pathname;
        var filename = url.substring(url.lastIndexOf('/')+1);
        $('a[href$="' + filename + '"]').addClass('active');
    });
</script>

</body>

</html>
