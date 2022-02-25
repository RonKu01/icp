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

                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>Logbook History</h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="#addLogbookModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Update Logbook</span></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Week</th>
                                    <th>Content</th>
                                    <th>Lecturer Comments</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql4 = "SELECT * FROM `logbook` WHERE student_unique_id = {$_SESSION['unique_id']} ORDER BY week ASC";

                                $result4 = $conn ->query($sql4);
                                if (!empty($result4) && $result4->num_rows > 0) {
                                    for ($i = 0; $i < mysqli_num_rows($result4); $i++){
                                        $row4  = mysqli_fetch_assoc($result4);
                                        echo '<tr>';
                                        echo '<td>'.$row4['week'].'</td>';
                                        echo '<td>'.$row4['content'].'</td>';
                                        echo '<td>'.$row4['comment'].'</td>';
                                        echo '<td></td>';
                                        echo '</tr>';
                                    }
                                }
                                mysqli_free_result($result4);
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Add Modal HTML -->
            <div id="addLogbookModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="was-validated" action="#" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
                            <div class="modal-header">
                                <h4 class="modal-title">Logbook</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="student_unique_id" value="<?php echo $_SESSION['unique_id']; ?>">
                                <div class="error-text"></div>

                                <div class="form-group">
                                    <label for="week">Week</label>
                                    <input id="week" name="week" type="number" min="1" max="20" class="form-control" required>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" id="addBtn" class="btn btn-success" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>


    </div>
</div>
<script src="../assets/javascript/add_logbook.js"></script>
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
