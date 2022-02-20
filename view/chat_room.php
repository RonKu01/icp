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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Chat Room</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Select an user to start chat</h3>
                    </div>
                    <div class="card-text">
                        <input type="text" class="form-control" id="Name" placeholder="Enter name to search...">
                        <label for="Name" class="visually-hidden">Name</label>
                    </div>
                </div>
            </div>
            <div class="card scroll">
                <div class="card-body">
                    <div class="card-text">
                        <div class="userlogin-list"></div>
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

<script src="../assets/javascript/chat_room.js"></script>

</body>





