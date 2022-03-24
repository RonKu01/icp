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
            require_once "nav_admin.php";
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="pt-5">
                <div class="container-xl">
                    <div class="row align-items-start">
                        <h1>Lecturer & Student Information</h1>
                            <div class="col">
                            <div class="table-responsive-sm">
                                <div class="table-wrapper">
                                    <div class="table-title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h2>Lecturers <b>List</b></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `lecturer` INNER JOIN userlogin ON lecturer.unique_id = userlogin.unique_id";

                                        $result = $conn ->query($sql);
                                        if (!empty($result) && $result->num_rows > 0) {
                                            for ($i = 0; $i < mysqli_num_rows($result); $i++){
                                                $row  = mysqli_fetch_assoc($result);

                                                $unique_id = $row['unique_id'];

                                                echo '<tr>';
                                                echo '<td>'.$row['name'].'</td>';
                                                echo '<td>'.$row['email'].'</td>';
                                                echo '</tr>';
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <div class="col">
                            <div class="table-responsive-sm">
                                <div class="table-wrapper">
                                    <div class="table-title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h2>Student <b>List</b></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `student` INNER JOIN userlogin ON student.unique_id = userlogin.unique_id ORDER BY student.id ASC";

                                        $result = $conn ->query($sql);
                                        if (!empty($result) && $result->num_rows > 0) {
                                            for ($i = 0; $i < mysqli_num_rows($result); $i++){
                                                $row  = mysqli_fetch_assoc($result);
                                                $unique_id = $row['unique_id'];
                                                echo '<tr>';
                                                echo '<td>'.$row['name'].'</td>';
                                                echo '<td>'.$row['email'].'</td>';

                                                echo '</tr>';
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
