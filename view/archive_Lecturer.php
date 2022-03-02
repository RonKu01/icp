<?php
    session_start();
    require_once "../controller/config.php";

    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
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
    <div class="py-5 px-3 mt-5 me-5">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="container-xl">
          <div class="table-responsive me-5">
              <div class="table-wrapper">
                  <div class="table-title">
                      <div class="row">
                          <div class="col-sm-6">
                              <h2><b>Archive System</b></h2>
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
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      $sql = "SELECT * FROM submission_archive INNER JOIN student ON submission_archive.student_unique_id = student.unique_id WHERE student.supervisor_unique_id = '{$_SESSION['unique_id']}'";

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
                              echo '<td><a href="../assets/fyp/'.$filesName.'" target="_blank"><i class="material-icons" style="font-size: 20px;"  title="View FYP">article</i></a>';
                              echo '<a href="#archiveConfirmationModal" onclick="return getDataForArchive(`'.$unique_id.'`)" class="text-info" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Archive">archive</i></a></td>';
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

        <!-- Archive Confirmation Modal HTML -->
        <div id="archiveConfirmationModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="archive_form">
                        <div class="modal-header">
                            <h4 class="modal-title">Archive Student FYP Project</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="error-text" id="error-text"></div>
                            <div id="archive-FYP-modal-body"></div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" id="btnArchive" class="btn btn-danger" value="Archive">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    </div>

    <script src="../assets/javascript/archive.js"></script>

    <script>
        function getDataForArchive(unique_id){
            return document.getElementById('archive-FYP-modal-body').innerHTML =
            '<div class="form-group">' +
            '<input id="unique_id" name="unique_id" type="hidden" class="form-control" value="'+ unique_id +'" readonly> ' +
            '</div>' +
            '<div class="p-1"><!--extra Spacing--></div>' +
            '<p>Are you sure you want to archive this Student FYP project?</p>'
        }
    </script>

</body>



