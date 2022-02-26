<?php
session_start();
require_once "../controller/config.php";

if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Files Upload and Download</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <form action="#" method="post" enctype="multipart/form-data"  autocomplete="off">
            <input type="hidden" name="student_unique_id" value="<?php echo $_SESSION['unique_id']?>">
          <h3>Upload File</h3>
            <input type="file" name="file" required>
          <button type="submit" name="submit">upload</button>
        </form>
      </div>
    </div>
    <script src="../assets/javascript/uploadFile.js"></script>
  </body>
</html>