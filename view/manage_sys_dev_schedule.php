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

            <div class="container-xl ">
                <div class="table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h2><b>FYP1 Schedule</b></h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Schedule</span></a>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Week</th>
                                        <th>Task</th>
                                        <th>Action</th>
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
                                            echo '<td>
                                             <a href="#editEmployeeModal" onclick="return getDataForEdit(`'.$id.'`,`'.$fyp_type.'`,`'.$row['week'].'`,`'.$row['task'].'`,`'.$row['remark'].'`)" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                             <a href="#deleteEmployeeModal" onclick="return getDataForDlt(`'.$id.'`)" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                         </td>';
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

            <!-- Add Modal HTML -->
            <div id="addEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="was-validated" action="#" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
                            <input id="fyp_type" name="fyp_type" type="hidden" class="form-control" value="fyp1">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Schedule</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="error-text"></div>
                                <div class="form-group">
                                    <label for="week">Week</label>
                                    <input id="week" name="week" type="number" class="form-control" required>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="task">Task</label>
                                    <textarea id="task" name="task" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <input type="checkbox" id="remark" name="remark" value="remark">
                                    <label for="remark"> Submission</label><br>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" id="addBtn" class="btn btn-success" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML -->
            <div id="editEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Schedule</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="error-text" id="error-text"></div>
                                <div id="edit-schedule-modal-body"></div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" id="updateBtn" class="btn btn-info" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Delete Modal HTML -->
            <div id="deleteEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title">Remove Schedule</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="error-text" id="error-text"></div>
                                <div id="delete-schedule-modal-body"></div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" id="dltBtn" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="../assets/javascript/add_schedule.js"></script>
<script src="../assets/javascript/update_schedule.js"></script>
<script src="../assets/javascript/delete_schedule.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="../assets/javascript/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../assets/javascript/dashboard.js"></script>

<script>
    $(document).ready(function(){
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // NavBar Active
        $('a.active').removeClass('active');
        var url = window.location.pathname;
        var filename = url.substring(url.lastIndexOf('/')+1);
        $('a[href$="' + filename + '"]').addClass('active');
    });
</script>

<script>
    function getDataForEdit(id, fyp_type, week, task, remark){
        return document.getElementById('edit-schedule-modal-body').innerHTML =
            '<input id="id" name="id" type="hidden" class="form-control" value="'+ id +'"> ' +

            '<div class="form-group">' +
            '<label for="week">Week</label> ' +
            '<input id="week" name="week" type="number" class="form-control" value="'+ week +'" readonly> ' +
            '</div>' +
            '<div class="p-1"><!--extra Spacing--></div>' +

            '<div class="form-group">' +
            '<label for="task">Task</label>' +
            '<textarea id="task" name="task" rows="5" class="form-control">' + task + '</textarea> ' +
            '</div>' +
            '<div class="p-1"><!--extra Spacing--></div>' +

            '<div class="form-group">' +
            '<input id="remark" name="remark" type="checkbox" value="'+ remark +'"> ' +
            '<label for="remark">Submission</label>' +
            '</div>' +
            '<div class="p-1"><!--extra Spacing--></div>';

    }

    function getDataForDlt(id){
        return document.getElementById('delete-schedule-modal-body').innerHTML =
            '<div class="form-group">' +
            '<input id="id" name="id" type="hidden" value="'+ id +'">' +
            '</div>' +
            '<div class="p-1"><!--extra Spacing--></div>' +
            '<p>Are you sure you want to delete these Records?</p>' +
            '<p class="text-warning">' +
            '<small>This action cannot be undone.</small>' +
            '</p>';
    }
</script>

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
