<?php
session_start();
require_once "../controller/config.php";

if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
?>

<?php include_once "header.php"; ?>

<style>
    .chat-box{
        position: relative;
        min-height: 500px;
        max-height: 500px;
        overflow-y: auto;
        padding: 10px 30px 20px 30px;
        background: #f7f7f7;
        box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
        inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
    }
    .chat-box .text{
        position: absolute;
        top: 45%;
        left: 50%;
        width: calc(100% - 50px);
        text-align: center;
        transform: translate(-50%, -50%);
    }
    .chat-box .chat{
        margin: 15px 0;
    }
    .chat-box .chat p{
        word-wrap: break-word;
        padding: 8px 16px;
        box-shadow: 0 0 32px rgb(0 0 0 / 8%),
        0rem 16px 16px -16px rgb(0 0 0 / 10%);
    }
    .chat-box .outgoing{
        display: flex;
    }
    .chat-box .outgoing .details{
        margin-left: auto;
        max-width: calc(100% - 130px);
    }
    .outgoing .details p{
        background: #333;
        color: #fff;
        border-radius: 18px 18px 0 18px;
    }
    .chat-box .incoming{
        display: flex;
        align-items: flex-end;
    }
    .chat-box .incoming img{
        height: 35px;
        width: 35px;
    }
    .chat-box .incoming .details{
        margin-right: auto;
        margin-left: 10px;
        max-width: calc(100% - 130px);
    }
    .incoming .details p{
        background: #fff;
        color: #333;
        border-radius: 18px 18px 18px 0;
    }
</style>

<body>

<?php
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$sql = mysqli_query($conn, "SELECT coordinator.name, coordinator.unique_id from userlogin
            INNER JOIN coordinator ON userlogin.unique_id = coordinator.unique_id WHERE userlogin.unique_id = '{$user_id}'
            UNION
            SELECT lecturer.name,lecturer.unique_id from userlogin
            INNER JOIN lecturer ON userlogin.unique_id = lecturer.unique_id WHERE userlogin.unique_id = '{$user_id}'
            UNION
            SELECT student.name, student.unique_id from userlogin
            INNER JOIN student ON userlogin.unique_id = student.unique_id WHERE userlogin.unique_id = '{$user_id}'");

if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
}else{
    header("location: chat_room.php");
}
?>

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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Chat Room</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2><?php echo $row['name'] ?></h2>
                        <a class="btn btn-outline-primary" href="chat_room.php">back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <div class="chat-box" id="chat-box"></div>
                    </div>
                </div>
            </div>
            <form action="#" class="typing-area">
                <input type="text" id="incoming_id" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <div class="input-group">
                    <input type="text" id="inputMsg" name="message" class="form-control" placeholder="Type a message here..." autocomplete="off">
                    <button id="sendBtn" class="btn btn-primary">Send</button>
                </div>
            </form>
        </main>
    </div>
</div>

<script src="../assets/javascript/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../assets/javascript/dashboard.js"></script>

<script src="../assets/javascript/chat.js"></script>

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
