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
            require_once "nav_admin.php";
            ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="container-xl">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2><b>FYP Progression Table</b></h2>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Supervisor Name</th>
                                    <th>Progression Stage</th>
                                    <th>Midterm Due Date</th>
                                    <th>Final Due Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>



                                    <?php
                                    $sql = "SELECT * FROM `progress` INNER JOIN student ON progress.student_unique_id = student.unique_id";

                                    $lecturer_unique_id_list = array();
                                    $lecturer_name_list = array();

                                    $sql2 = "SELECT * FROM `lecturer`";
                                    $result2 = $conn -> query($sql2);
                                    for ($i = 0; $i < mysqli_num_rows($result2); $i++) {
                                        $row2 = mysqli_fetch_assoc($result2);
                                        $lecturer_unique_id_list[$i] = $row2['unique_id'];
                                        $lecturer_name_list[$i] = $row2['name'];
                                    }

                                    $encoded_lecturer_unique_id = json_encode($lecturer_unique_id_list);
                                    $encoded_lecturer_name = json_encode($lecturer_name_list);

                                    $lecturer_list_length = count($lecturer_unique_id_list);

                                    $result = $conn ->query($sql);
                                    if (!empty($result) && $result->num_rows > 0) {
                                        for ($i = 0; $i < mysqli_num_rows($result); $i++){
                                            $row  = mysqli_fetch_assoc($result);

                                            $unique_id = $row['unique_id'];

                                            echo '<tr>';
                                            echo '<td>'.$row['name'].'</td>';
                                            if($row['lecturer_unique_id']==0){
                                                echo '<td>not_set</td>';
                                            }else{
                                                $sql3 = "SELECT * FROM `lecturer` WHERE lecturer.unique_id = '{$unique_id}'";

                                                echo '<td>'.$row['lecturer_unique_id'].'</td>';
                                            }
                                            echo '<td>'.$row['progress_stage'].'</td>';
                                            echo '<td>'.$row['proposal_due'].'</td>';
                                            echo '<td>'.$row['final_due'].'</td>';
                                            echo '<td>
                                                     <a href="#editEmployeeModal" onclick="return getDataForEdit(`'.$row['student_unique_id'].'`,`'.$row['name'].'`,`'.$row['lecturer_unique_id'].'`,`'.$row['progress_stage'].'`,`'.$row['proposal_due'].'`,`'.$row['final_due'].'`)" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
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

                <!-- Assign Supervisor -->
                <div id="editEmployeeModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <h4 class="modal-title">Assign Supervisor</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-text" id="error-text"></div>

                                    <div id="assign-supervisor-modal-body"></div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" id="updateBtn" class="btn btn-info" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>

    <script src="../assets/javascript/supervisor_assign.js"></script>

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

        <script>
            function getDataForEdit(student_unique_id, student_name, lecturer_unique_id, progress_stage, proposal_due, final_due){

                var lec_unique_id = <?php echo $encoded_lecturer_unique_id?>;
                var lec_name = <?php echo $encoded_lecturer_name?>;

                let y = '';

                for(let i = 0; i < lec_unique_id.length; i++){
                    var z = '<option value="' + lec_unique_id[i] + '">' + lec_name[i] +'</option> +';
                    y = y.concat(z);
                }

                return document.getElementById('assign-supervisor-modal-body').innerHTML =
                    '<input id="student_unique_id" name="student_unique_id" type="hidden" value="'+ student_unique_id +'"> ' +
                    '<div class="form-group">' +
                    '<label for="name">Name</label> ' +
                    '<input id="name" name="name" type="text" class="form-control" value="'+ student_name +'" readonly> ' +
                    '</div>' +
                    '<div class="p-1"><!--extra Spacing--></div>' +

                    '<div class="form-group">' +
                    '<label for="supervisor_unique_id">Supervisor Name</label> ' +
                    '<select class="form-select form-select-sm" name="supervisor_unique_id" aria-label=".form-select-sm example">' +
                        '<option value="' + lecturer_unique_id + '" selected>Default</option>' +
                        y +
                    '</select>' +
                    '</div>' +
                    '<div class="p-1"><!--extra Spacing--></div>' +

                    '<div class="form-group">' +
                    '<label for="progress_stage">Progression Stage</label> ' +
                    '<select class="form-select form-select-sm" aria-label=".form-select-sm example" name="progress_stage" required>' +
                        '<option selected>Select Progression Stage</option>' +
                        '<option value="1">Planning</option>' +
                        '<option value="2">Analysis</option>' +
                        '<option value="3">Design</option>' +
                        '<option value="4">Implementing</option>' +
                        '<option value="5">Test</option>' +
                        '<option value="6">Completed</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="p-1"><!--extra Spacing--></div>' +

                    '<div class="form-group">' +
                    '<label for="proposal_due">Midterm Due Date</label> ' +
                    '<input id="proposal_due" name="proposal_due" type="date" class="form-control" value="'+ proposal_due +'" required> ' +
                    '</div>' +
                    '<div class="p-1"><!--extra Spacing--></div>' +

                    '<div class="form-group">' +
                    '<label for="final_due">Final Due Date</label> ' +
                    '<input id="final_due" name="final_due" type="date" class="form-control" value="'+ final_due +'" required> ' +
                    '</div>' +
                    '<div class="p-1"><!--extra Spacing--></div>' ;
            }
        </script>
</body>

</html>
