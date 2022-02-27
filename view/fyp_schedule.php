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
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
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
            require_once "nav_student.php";
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="pt-5">
                <div class="container-xl ">
                    <div class="row align-items-start">
                        <div class="col">
                            <div class="table-responsive-sm">
                                <div class="table-wrapper">
                                    <div class="table-title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4><b>FYP1 Schedule</b></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Task</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `sys_dev_schedule` WHERE fyp_type = 'fyp1'";

                                        $result = $conn ->query($sql);
                                        if (!empty($result) && $result->num_rows > 0) {
                                            for ($i = 0; $i < mysqli_num_rows($result); $i++){
                                                $row  = mysqli_fetch_assoc($result);

                                                $id = $row['id'];
                                                $fyp_type = $row['fyp_type'];

                                                echo '<tr>';
                                                echo '<td>'.$row['week'].'</td>';
                                                echo '<td>'.$row['task'].'</td>';
                                                echo '<td>'.$row['remark'].'</td>';
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
                                                <h4><b>FYP2 Schedule</b></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Task</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `sys_dev_schedule` WHERE fyp_type = 'fyp2'";

                                        $result = $conn ->query($sql);
                                        if (!empty($result) && $result->num_rows > 0) {
                                            for ($i = 0; $i < mysqli_num_rows($result); $i++){
                                                $row  = mysqli_fetch_assoc($result);

                                                $id = $row['id'];
                                                $fyp_type = $row['fyp_type'];

                                                echo '<tr>';
                                                echo '<td>'.$row['week'].'</td>';
                                                echo '<td>'.$row['task'].'</td>';
                                                echo '<td>'.$row['remark'].'</td>';
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
