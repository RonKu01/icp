<?php
session_start();
require_once "../controller/config.php";

if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}

$studentid = $_GET['student_unique_id'];
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
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Week</th>
                                    <th>Content</th>
                                    <th>Comments</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql4 = "SELECT * FROM `logbook` WHERE student_unique_id = {$studentid} ORDER BY week ASC";

                                $result4 = $conn ->query($sql4);
                                if (!empty($result4) && $result4->num_rows > 0) {
                                    for ($i = 0; $i < mysqli_num_rows($result4); $i++){
                                        $row4  = mysqli_fetch_assoc($result4);

                                        $id = $row4['id'];

                                        echo '<tr>';
                                        echo '<td>'.$row4['week'].'</td>';
                                        echo '<td>'.$row4['content'].'</td>';
                                        echo '<td>'.$row4['comment'].'</td>';
                                        echo '<td>
                                                 <a href="#editEmployeeModal" onclick="return getDataForEdit(`'.$id.'`,`'.$row4['week'].'`,`'.$row4['content'].'`,`'.$row4['comment'].'`)" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Remarks">&#xE254;</i></a>
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

                <div id="editEmployeeModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <h4 class="modal-title">Comments LogBook</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body" >
                                    <div class="error-text" id="error-text"></div>
                                    <div id="logbook-comment-modal-body"></div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" id="updateBtn" class="btn btn-info" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>


    </div>
</div>

<script src="../assets/javascript/lec_comment.js"></script>

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
    function getDataForEdit(id, week, content, comment){
        return document.getElementById('logbook-comment-modal-body').innerHTML =
            '<input id="id" name="id" type="hidden" class="form-control" value="'+ id +'" readonly> ' +

            '<div class="form-group">' +
            '<label for="week">Week</label> ' +
            '<input id="week" name="week" type="text" class="form-control" value="'+ week +'" readonly> ' +
            '</div>' +
            '<div class="p-1"><!--extra Spacing--></div>' +

            '<div class="form-group">' +
            '<label for="content">Content</label> ' +
            '<input id="content" name="content" type="text" class="form-control" value="'+ content +'" readonly> ' +
            '</div>' +
            '<div class="p-1"><!--extra Spacing--></div>' +

            '<div class="form-group">' +
            '<label for="comment">Comments</label> ' +
            '<textarea id="comment" name="comment" rows="5" placeholder="Type Message" class="form-control" value="'+ comment +'" required>' +
            '</textarea>' +
            '</div>' +
            '<div class="p-1"><!--extra Spacing--></div>' ;
    }
</script>


</body>

</html>
