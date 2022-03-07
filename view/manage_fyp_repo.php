<?php
session_start();
require_once "../controller/config.php";

if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
?>

<?php include_once "header.php"; ?>

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
                                        <h2>Manage <b>FYP Repository</b></h2>
                                    </div>
                                </div>
                            </div>
                            <input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search by Student names.">
                            <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search by FYP Title.">

                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>FYP Title</th>
                                    <th>Files Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `submission_archive` INNER JOIN student ON submission_archive.student_unique_id = student.unique_id WHERE status = 'Archived' ORDER BY student.id ASC";

                                    $result = $conn ->query($sql);
                                    if (!empty($result) && $result->num_rows > 0) {
                                        for ($i = 0; $i < mysqli_num_rows($result); $i++){
                                            $row  = mysqli_fetch_assoc($result);
                                            $unique_id = $row['unique_id'];
                                            echo '<tr>';
                                            echo '<td>'.$row['id'].'</td>';
                                            echo '<td>'.$row['name'].'</td>';
                                            echo '<td>'.$row['fyp_title'].'</td>';
                                            echo '<td>'.$row['filesName'].'</td>';
                                            echo '<td>'.$row['date'].'</td>';
                                            echo '<td><a href="../assets/fyp/'.$row['filesName'].'" target="_blank" style="color: gray"><i class="material-icons" data-toggle="tooltip" title="FYP">&#xe850;</i></a></td>';
                                            echo '</tr>';
                                        }
                                    }
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            $('a.active').removeClass('active');
            var url = window.location.pathname;
            var filename = url.substring(url.lastIndexOf('/')+1);
            $('a[href$="' + filename + '"]').addClass('active');
        });
    </script>
    <script>
        function myFunction1() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput1");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function myFunction2() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput2");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>
