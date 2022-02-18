<?php
session_start();
if(isset($_SESSION['unique_id'])){
    header("location: chat_room.php");
}
?>

<?php include_once "header.php"; ?>
<link href="../assets/css/login.css" rel="stylesheet">

<body class="text-center">
    <h1>DeLETE THIS</h1>
    <main class="form-signin">
        <h1 class="h2 mb-3 fw-bold">ICP Assignment</h1>
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
            <div class="checkbox mb-4">
                <label>
                    <input type="checkbox" onclick="showPw()" > Show Password
                </label>
            </div>
            <button  class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-2 mb-3 text-muted">&copy; Team Neon 2022</p>
        </form>
    </main>

    <script src="../assets/javascript/pass-show-hide.js"></script>
    <script src="../assets/javascript/login.js"></script>
</body>
