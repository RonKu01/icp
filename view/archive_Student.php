<?php
    session_start();
    require_once "../controller/config.php";

    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }

    $select_query = mysqli_query($conn, "SELECT * FROM student WHERE student.unique_id = '".$_SESSION['unique_id']."';");
    if(mysqli_num_rows($select_query) > 0){
        $result = mysqli_fetch_assoc($select_query);
    }
?>

<?php include_once "header.php"; ?>
<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Archive System</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <label class="form-control form-control-dark w-100" style="text-align: center"><?php echo $_SESSION['roles']; ?></label>
      <div class="navbar-nav">
          <div class="nav-item text-nowrap">
              <a class="nav-link px-3" href="archive_login.php">Back to System</a>
          </div>
      </div>
  </header>
  <div class="py-5 px-3 mt-3 me-5">
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="container-xl">
              <div class=" col-lg-6">
                  <div id="msg_banner"></div>
                  <h4 class="mb-3">Upload FYP File</h4>
                  <form class="needs-validation" id="upload_form" action="#" method="post" enctype="multipart/form-data"  autocomplete="off" novalidate>
                      <div class="row g-2">
                          <div class="col-sm-6">
                              <label for="student_unique_id" class="form-label">Student Unique ID</label>
                              <input type="text" class="form-control" id="student_unique_id" name="student_unique_id" value="<?php echo $_SESSION['unique_id']?>" readonly>
                          </div>

                          <div class="col-sm-6">
                              <label for="student_name" class="form-label">Student Name</label>
                              <input type="text" class="form-control" id="student_name" name="student_name" value="<?php echo $result['name']?>" readonly>
                          </div>

                          <div class="col-sm-12">
                              <label for="name" class="form-label">Files</label>
                              <input type="file" name="file" class="form-control" required>
                          </div>
                      </div>
                      <br/>
                      <button class="w-100 btn btn-primary btn-lg" id="btnSubmit" type="submit" name="submit">Upload / Resubmit</button>
                  </form>
                  <hr class="my-4">
              </div>


              <div class="table-responsive me-5">
                  <div class="table-wrapper">
                      <div class="table-title">
                          <div class="row">
                              <div class="col-sm-6">
                                  <h2><b>Previous Submission</b></h2>
                              </div>
                          </div>
                      </div>
                      <table class="table table-striped table-hover">
                          <thead>
                          <tr>
                              <th>StudentID</th>
                              <th>Student Name</th>
                              <th>Files</th>
                              <th>Archive Status</th>
                              <th></th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                          $sql = "SELECT * FROM submission_archive INNER JOIN student ON submission_archive.student_unique_id = student.unique_id WHERE student.unique_id = '{$_SESSION['unique_id']}'";

                          $result = $conn ->query($sql);
                          if (!empty($result) && $result->num_rows > 0) {
                              for ($i = 0; $i < mysqli_num_rows($result); $i++){
                                  $row  = mysqli_fetch_assoc($result);
                                  $unique_id = $row['unique_id'];
                                  $name = $row['name'];
                                  $filesName = $row['filesName'];
                                  $status = $row['status'];

                                  echo '<tr>';
                                  echo '<td>'.$unique_id.'</td>';
                                  echo '<td>'.$name.'</td>';
                                  echo '<td>'.$filesName.'</td>';
                                  echo '<td>'.$status.'</td>';
                                  echo '<td></td>';
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
      </main>
  </div>

  <script src="../assets/javascript/uploadFile.js"></script>
</body>
