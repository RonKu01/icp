<?php
session_start();
require_once "../controller/config.php";

if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
?>

<?php include_once "header.php"; ?>
<style>
    .scroll {
        max-height: 1500px;
        overflow-y: auto;
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
                <!--ReplyModal-->
                <div id="ReplyModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Reply Questions</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form class="was-validated" name="frm1" action="#" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
                                <input type="hidden" id="Runique_id" name="Runique_id" value="<?php echo $_SESSION['unique_id']; ?>">
                                <input type="hidden" id="Rcommentid" name="Rcommentid">

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Rmsg">Write your reply</label>
                                        <textarea id="Rmsg" class="form-control" rows="5" name="Rmsg" required></textarea>
                                    </div>
                                    <div class="p-1"><!--extra Spacing--></div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" id="btnreply" name="btnreply" class="btn btn-success" value="Reply">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="panel panel-default" style="margin-top:50px">
                        <div class="panel-body">
                            <h1>Forum</h1>
                            <hr>
                            <form name="frm" method="post">
                                <input type="hidden" id="commentid" name="Pcommentid" value="0">
                                <input type="hidden" id="unique_id" name="unique_id" value="<?php echo $_SESSION['unique_id']; ?>">

                                <div class="form-group">
                                    <label for="category">Questions Category:</label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="FYP1">FYP1</option>
                                        <option value="FYP2">FYP2</option>
                                    </select>
                                </div>
                                <div class="p-2"><!--extra Spacing--></div>

                                <div class="form-group">
                                    <label for="comment">Write your question:</label>
                                    <textarea class="form-control" rows="5" name="msg" required></textarea>
                                </div>
                                <div class="p-1"><!--extra Spacing--></div>
                                <input type="button" id="butsave" name="save" class="btn btn-primary" value="Send">
                            </form>
                        </div>
                    </div>
                    <div class="p-2"><!--extra Spacing--></div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4>Recent Discussion</h4>
                            <table class="table" id="forumTable" style="background-color: #edfafa; border:0px;border-radius:10px">
                                <tbody id="record"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../assets/javascript/forum.js"></script>
    <script src="../assets/javascript/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../assets/javascript/dashboard.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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

</body>

</html>
