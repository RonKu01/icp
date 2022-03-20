<?php
session_start();
require_once "../controller/config.php";

if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
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
                <div class="container-xl">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2><b>Supervisee List</b></h2>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Meeting Date</th>
                                    <th>Schedule Meeting</th>
                                    <th>Logbook Review</th>
                                    <th>FYP Project</th>
                                    <th>Grade</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM student WHERE supervisor_unique_id = {$_SESSION['unique_id']}";

                                $result = $conn ->query($sql);
                                if (!empty($result) && $result->num_rows > 0) {
                                    for ($i = 0; $i < mysqli_num_rows($result); $i++){
                                        $row  = mysqli_fetch_assoc($result);
                                        $unique_id = $row['unique_id'];

                                        $sql3 = "SELECT `start_event` FROM meeting WHERE student_unique_id = '{$unique_id}' ORDER BY `id` DESC LIMIT 1;";
                                        $resul3 = $conn ->query($sql3);
                                        $row3 = mysqli_fetch_assoc($resul3);

                                        $meeting = $row3['start_event'] ?? 'No meeting schedule.';

                                        $select_sql = "SELECT filesName FROM submission_archive INNER JOIN student ON submission_archive.student_unique_id = student.unique_id WHERE student.unique_id = '{$unique_id}'";

                                        $result5 = $conn ->query($select_sql);
                                        if (!empty($result5) && $result5->num_rows > 0) {
                                            $row4 = mysqli_fetch_assoc($result5);
                                        }

                                        $filesName = $row4['filesName'] ?? 'Not Submitted yet';

                                        echo '<tr>';
                                        echo '<td>'.$row['unique_id'].'</td>';
                                        echo '<td>'.$row['name'].'</td>';
                                        echo '<td>'.$meeting.'</td>';
                                        echo '<td> <a href="schedule_meeting.php?student_unique_id='.$unique_id.'" style="color: gray"><i class="material-icons" data-toggle="tooltip" title="Schedule Meeting">&#xe614;</i></a></td>';
                                        echo '<td><a href="lec_view_logbook.php?student_unique_id='.$unique_id.'" style="color: gray"><i class="material-icons" data-toggle="tooltip" title="Logbook">&#x2709;</i></a></td>';

                                        if ($filesName == 'Not Submitted yet'){
                                            echo '<td>Not Submitted yet</td>';
                                        } else {
                                            echo '<td><a href="../assets/fyp/'.$filesName.'" target="_blank" style="color: gray"><i class="material-icons" data-toggle="tooltip" title="FYP">&#xe24d;</i></a></td>';
                                        }

                                        echo '<td>
                                               <a href="grade.php?student_unique_id='.$unique_id.'" style="color: gray"><i class="material-icons" data-toggle="tooltip" title="Grade">&#xe2e6;</i></a>
                                               <a href="summary_grade.php?student_unique_id='.$unique_id.'" style="color: gray"><i class="material-icons" data-toggle="tooltip" title="Summary Grade">&#xf075;</i></a></td>';
                                        echo '</tr>';
                                    }
                                }
                                mysqli_free_result($result);
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2><b>Second Marker's List</b></h2>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th></th>
                                    <th>Comment</th>
                                    <th>FYP Project</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sql = "SELECT * FROM student WHERE second_marker_unique_id = {$_SESSION['unique_id']}";
                                    $result = $conn ->query($sql);
                                    if (!empty($result) && $result->num_rows > 0) {
                                        for ($i = 0; $i < mysqli_num_rows($result); $i++){
                                            $row  = mysqli_fetch_assoc($result);
                                            $unique_id = $row['unique_id'];

                                            echo '<tr>';
                                            echo '<td>'.$row['unique_id'].'</td>';
                                            echo '<td>'.$row['name'].'</td>';
                                            echo '<td></td>';

                                            $sql2 = "SELECT sec_marker_comment FROM grade WHERE student_unique_id = {$unique_id}";
                                            $result2 = $conn ->query($sql2);
                                            if (!empty($result2) && $result2->num_rows > 0) {
                                                $row2 = mysqli_fetch_assoc($result2);
                                            }

                                            $select_sql = "SELECT filesName FROM submission_archive INNER JOIN student ON submission_archive.student_unique_id = student.unique_id WHERE student.unique_id = '{$unique_id}'";

                                            $result3 = $conn ->query($select_sql);
                                            if (!empty($result3) && $result3->num_rows > 0) {
                                                for ($i = 0; $i < mysqli_num_rows($result3); $i++) {
                                                    $row5 = mysqli_fetch_assoc($result3);
                                                }
                                            }

                                            $filesName = $row5['filesName'] ?? 'Not Submitted yet';
                                            $sec_marker_comment = $row2['sec_marker_comment'] ?? 'Not Set';
                                            echo '<td>'.$sec_marker_comment.'</td>';
                                            if ($filesName == 'Not Submitted yet'){
                                                echo '<td>Not Submitted yet</td>';
                                            } else {
                                                echo '<td><a href="../assets/fyp/'.$filesName.'" target="_blank" style="color: gray"><i class="material-icons" data-toggle="tooltip" title="FYP">&#xe24d;</i></a></td>';
                                            }

                                            echo '<td>
                                                      <a href="second_marker_grade.php?student_unique_id='.$unique_id.'" style="color: gray"><i class="material-icons" data-toggle="tooltip" title="Review">&#xf009;</i></a>
                                                  </td>';
                                            echo '</tr>';
                                        }
                                    }
                                    mysqli_free_result($result);
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

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
