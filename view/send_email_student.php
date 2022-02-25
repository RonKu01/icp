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
                <div class="py-5 px-3">
                    <div class="col-md-7 col-lg-4">
                        <div id="msg_banner"></div>
                        <h4 class="mb-3">Send Email</h4>
                        <form class="needs-validation" id="emailForm" novalidate>
                            <div class="row g-2">
                                <div class="col-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text" placeholder="Enter Name" class="form-control" name="name">
                                </div>

                                <div class="col-12">
                                    <label for="sender_email" class="form-label">Sender Email</label>
                                    <input id="sender_email" type="email" placeholder="Enter Sender Email" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label for="recipient_email" class="form-label">Recipient Email</label>
                                    <input id="recipient_email" type="email" placeholder="Enter Recipient Email" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input id="subject" type="text" placeholder=" Enter Subject" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="body" rows="5" placeholder="Type Message" class="form-control"></textarea>
                                </div>

                            </div>

                            <hr class="my-4">

                            <button type="button" onclick="sendEmail()" value="Send An Email" class="w-100 btn btn-primary btn-lg" >Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>


    </div>
</div>

<script src="../assets/javascript/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../assets/javascript/dashboard.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    function sendEmail() {
        var name = $("#name");
        var sender_email = $("#sender_email");
        var recipient_email = $("#recipient_email");
        var subject = $("#subject");
        var body = $("#body");

        if (isNotEmpty(name) && isNotEmpty(sender_email) && isNotEmpty(recipient_email) && isNotEmpty(subject) && isNotEmpty(body)) {
            $.ajax({
                url: '../controller/sendEmailToSupervisor.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    name: name.val(),
                    sender_email: sender_email.val(),
                    recipient_email: recipient_email.val(),
                    subject: subject.val(),
                    body: body.val()
                }, success: function (response) {
                    $('#emailForm')[0].reset();
                    $('.sent-notification').text("Message Sent Successfully.");
                }
            });
        }
    }

    function isNotEmpty(caller) {
        if (caller.val() == "") {
            caller.css('border', '1px solid red');
            return false;
        } else
            caller.css('border', '');

        return true;
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






