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

            <div class="container-xl">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2>Manage <b>Students</b></h2>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Student</span></a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Unique_ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Programme</th>
                                <th>Year</th>
                                <th>CGPA</th>
                                <th>Phone Number</th>
                                <th>FYP Project Title</th>
                                <th>Supervisor's Name</th>
                                <th>password</th>
                                <th>Action</th>
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
                                        echo '<td>'.$row['unique_id'].'</td>';
                                        echo '<td>'.$row['name'].'</td>';
                                        echo '<td>'.$row['email'].'</td>';
                                        echo '<td>'.$row['programme'].'</td>';
                                        echo '<td>'.$row['year'].'</td>';
                                        echo '<td>'.$row['cgpa'].'</td>';
                                        echo '<td>'.$row['phone_num'].'</td>';
                                        echo '<td>'.$row['fyp_title'].'</td>';

                                        if($row['supervisor_unique_id']==0){
                                            echo '<td>not_set</td>';
                                        }else{
                                            $sql2 = "SELECT * FROM `lecturer` WHERE lecturer.unique_id = '{$row['supervisor_unique_id']}'";

                                            $result2 = $conn ->query($sql2);
                                            if (!empty($result2) && $result2->num_rows > 0) {
                                                $row2  = mysqli_fetch_assoc($result2);
                                            }
                                            echo '<td>'.$row2['name'].'</td>';
                                        }
                                        echo '<td>'.$row['password'].'</td>';
                                        echo '<td>
                                                 <a href="#editEmployeeModal" onclick="return getDataForEdit(`'.$row['unique_id'].'`,`'.$row['name'].'`,`'.$row['email'].'`,`'.$row['programme'].'`,`'.$row['year'].'`,`'.$row['cgpa'].'`,`'.$row['phone_num'].'`,`'.$row['fyp_title'].'`,`'.$row['supervisor_unique_id'].'`,`'.$row['password'].'`)" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                                 <a href="#deleteEmployeeModal" onclick="return getDataForDlt(`'.$row['unique_id'].'`)" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                              </td>';
                                        echo '</tr>';
                                    }
                                }
                                mysqli_free_result($result);
                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Add Modal HTML -->
            <div id="addEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="was-validated" action="#" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
                            <div class="modal-header">
                                <h4 class="modal-title">Add Student</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input id="supervisor_unique_id" name="supervisor_unique_id" type="hidden" value="none">
                                <div class="error-text"></div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" type="text" class="form-control" required>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="email" class="form-control" required>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="programme">Programme</label>
                                    <input id="programme" name="programme" type="text" class="form-control" required>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input id="year" name="year" type="text" class="form-control" required>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="cgpa">CGPA</label>
                                    <input id="cgpa" name="cgpa" type="text" class="form-control" required>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="phone_num">Phone Number</label>
                                    <input id="phone_num" name="phone_num" type="text" class="form-control" required>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="fyp_title">FYP Project Title</label>
                                    <input id="fyp_title" name="fyp_title" type="text" class="form-control" required>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" class="form-control" required>
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

            <!-- Edit Modal HTML -->
           <div id="editEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Student</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body" >
                                <div class="error-text" id="error-text"></div>
                                <div id="edit-Student-modal-body"></div>
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
                                <h4 class="modal-title">Delete Student</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="error-text" id="error-text"></div>
                                <div id="delete-Student-modal-body"></div>
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

<script src="../assets/javascript/add_Student.js"></script>
<script src="../assets/javascript/update_Student.js"></script>
<script src="../assets/javascript/delete_Student.js"></script>

<script src="../assets/javascript/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../assets/javascript/dashboard.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>

    function getDataForEdit(unique_id, name, email, programme, year, cgpa, phone_num, fyp_title, supervisor_unique_id, password){
        return document.getElementById('edit-Student-modal-body').innerHTML =
        '<div class="form-group">' +
            '<label for="unique_id">UniqueID</label> ' +
            '<input id="unique_id" name="unique_id" type="text" class="form-control" value="'+ unique_id +'" readonly> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' +

        '<div class="form-group">' +
        '<label for="name">Name</label> ' +
        '<input id="name" name="name" type="text" class="form-control" value="'+ name +'" readonly> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' +

        '<div class="form-group">' +
        '<label for="email">Email</label> ' +
        '<input id="email" name="email" type="email" class="form-control" value="'+ email +'" required> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' +

        '<div class="form-group">' +
        '<label for="programme">Programme</label> ' +
        '<input id="programme" name="programme" type="text" class="form-control" value="'+ programme +'" required> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' +

        '<div class="form-group">' +
        '<label for="year">Year</label> ' +
        '<input id="year" name="year" type="text" class="form-control" value="'+ year +'" required> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' +

        '<div class="form-group">' +
        '<label for="cgpa">CGPA</label> ' +
        '<input id="cgpa" name="cgpa" type="text" class="form-control" value="'+ cgpa +'" required> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' +

        '<div class="form-group">' +
        '<label for="phone_num">Phone Number</label> ' +
        '<input id="phone_num" name="phone_num" type="text" class="form-control" value="'+ phone_num +'" required> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' +

        '<div class="form-group">' +
        '<label for="fyp_title">FYP Project Title</label> ' +
        '<input id="fyp_title" name="fyp_title" type="text" class="form-control" value="'+ fyp_title +'" required> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' +

        '<div class="form-group">' +
        '<label for="supervisor_unique_id">Supervisor Name</label> ' +
        '<input id="supervisor_unique_id" name="supervisor_unique_id" type="text" class="form-control" value="'+ supervisor_unique_id +'" required> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' +

        '<div class="form-group">' +
        '<label for="password">Password</label> ' +
        '<input id="password" name="password" type="password" class="form-control" value="'+ password +'" required> ' +
        '</div>' +
        '<div class="p-1"><!--extra Spacing--></div>' ;

    }

    function getDataForDlt(unique_id){
        return document.getElementById('delete-Student-modal-body').innerHTML =
            '<div class="form-group">' +
            '<input id="unique_id" name="unique_id" type="hidden" class="form-control" value="'+ unique_id +'" readonly> ' +
            '</div>' +
            '<div class="p-1"><!--extra Spacing--></div>' +
            '<p>Are you sure you want to delete these Records?</p>' +
            '<p class="text-warning">' +
            '<small>This action cannot be undone.</small>' +
            '</p>'
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
