<?php
session_start();
require_once "../controller/config.php";
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
?>

<?php include_once "header.php"; ?>
<style>
    #msg_banner{
        color: black;
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

        <?php
            $select_query = mysqli_query($conn, "SELECT * FROM lecturer INNER JOIN userlogin ON lecturer.unique_id = userlogin.unique_id WHERE lecturer.unique_id = '".$_SESSION['unique_id']."';");
            if(mysqli_num_rows($select_query) > 0){
                $result = mysqli_fetch_assoc($select_query);
            }
        ?>
            <div class="container-xl">
                <div class="py-5 px-3">
                    <div class="col-md-7 col-lg-4">
                    <div id="msg_banner"></div>
                    <h4 class="mb-3">Lecturer Profile</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-2">
                            <div class="col-sm-6">
                                <label for="unique_id" class="form-label">Unique ID</label>
                                <input type="text" class="form-control" id="unique_id" name="unique_id" value="<?php echo $result['unique_id']?>" readonly>
                            </div>

                            <div class="col-sm-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name']?>" readonly>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $result['email']?>" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="position" class="form-label">Position</label>
                                <input type="position" class="form-control" id="position" name="position" value="<?php echo $result['position']?>" required>
                                <div class="invalid-feedback">
                                    Please enter your Position.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="major" class="form-label">Major</label>
                                <input type="major" class="form-control" id="major" name="major" value="<?php echo $result['major']?>" required>
                                <div class="invalid-feedback">
                                    Please enter your Major.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="research" class="form-label">Research</label>
                                <input type="research" class="form-control" id="research" name="research" value="<?php echo $result['research']?>" required>
                                <div class="invalid-feedback">
                                    Please enter your Research.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="interest" class="form-label">Interest</label>
                                <input type="interest" class="form-control" id="interest" name="interest" value="<?php echo $result['interest']?>" required>
                                <div class="invalid-feedback">
                                    Please enter your Interest.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $result['password']?>" required>
                                <div class="invalid-feedback">
                                    Please enter your Password.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Update</button>
                    </form>
                </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="../assets/javascript/profile_Lecturer.js"></script>


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

