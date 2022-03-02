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


                <div class="py-lg-5 px-3 ">
                    <div class="container me-5 mt-5">
                        <h1 class="h2 mb-3 fw-bold">Login - Archive System </h1>
                        <form class="was-validated" action="#" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
                            <div class="error-text"></div>
                            <div class="form-floating">
                                <input type="text" id="userID" class="form-control" name="login_id" placeholder="Enter your userID" required />
                                <label for="userID">User ID</label>
                            </div>
                            <div class="p-1"><!--extra Spacing--></div>
                            <div class="form-floating">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required />
                                <label for="password">Password</label>
                            </div>
                            <div class="checkbox mb-4 pt-3">
                                <label>
                                    <input type="checkbox" onclick="showPw()" > Show Password
                                </label>
                            </div>
                            <button  class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                            <p class="mt-2 mb-3 text-muted">&copy; Team Neon 2022</p>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="../assets/javascript/pass-show-hide.js"></script>
    <script src="../assets/javascript/login_archive.js"></script>
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

