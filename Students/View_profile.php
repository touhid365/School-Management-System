                <!--- Header start --->
                  <?php include 'header.php'; ?>
                <!-- End of Header -->

                <!-- Begin Page Content -->
                <!-- <div class="container-fluid">  -->

                    <!-- Page Heading -->
                    <section style="background: #f8f9fc;">
                        <div class="container py-5">
                          <!-- <div class="row"> --
                            <div class="col">
                              <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                                <ol class="breadcrumb mb-0">
                                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                  - <li class="breadcrumb-item"><a href="#">User</a></li> --
                                  <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                              </nav>
                            </div>
                          - </div> -->
                      
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="card mb-4" style="box-shadow: 0 0 0 0.1rem rgba(78, 115, 223, 0.25);">
                                <div class="card-body text-center">
                                  <!-- <img src="../images/state university.jpg" alt="avatar"
                                   class="rounded-circle img-fluid" style="width: 150px;"> -->
                                  <?php
                                  if($user['profile_image'] == ''){
                                  echo '<img src="../images/state university.jpg" class="rounded-circle img-fluid" style="width: 150px;">';
                                  }else{
                                  echo '<img src="uploads/'.$user['profile_image'].'" class="rounded-circle img-fluid" style="width: 150px;">';
                                  }
                                  ?>
                                  <h5 class="my-3">Student</h5>
                                  <p class="text-muted mb-1">Stream: <?php echo htmlspecialchars($user['stream']); ?></p>
                                  <p class="text-muted mb-4"> Roll No: <?php echo htmlspecialchars($user['roll_number']); ?></p>
                                  <div class="d-flex justify-content-center mb-2" style="gap: 5px;">
                                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>
                                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
                                  </div>
                                </div>
                              </div>
                              <div class="card mb-4 mb-lg-0" style="box-shadow: 0 0 0 0.1rem rgba(78, 115, 223, 0.25);">
                                <div class="card-body p-0">
                                  <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                      <i class="fas fa-globe fa-lg text-warning"></i>
                                      <p class="mb-0">https://mdbootstrap.com</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                      <i class="fab fa-github fa-lg text-body"></i>
                                      <p class="mb-0">mdbootstrap</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                      <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                      <p class="mb-0">@mdbootstrap</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                      <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                      <p class="mb-0">mdbootstrap</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                      <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                      <p class="mb-0">mdbootstrap</p>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-8">
                              <div class="card mb-4" style="box-shadow: 0 0 0 0.1rem rgba(78, 115, 223, 0.25);">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($user['first_name']); ?> <?php echo htmlspecialchars($user['last_name']); ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($user['email']); ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Phone</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($user['mobile_no']); ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Mobile</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($user['mobile_no']); ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Gender</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($user['gender']); ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Address</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($user['address']); ?>, <?php echo htmlspecialchars($user['city']); ?>, <?php echo htmlspecialchars($user['state']); ?>, <?php echo htmlspecialchars($user['zip']); ?></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                      <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                      </p>
                                      <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                      <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                      <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                      <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                      <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                      <div class="progress rounded mb-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                      <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                      </p>
                                      <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                      <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                      <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                      <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                      <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                      <div class="progress rounded mb-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                          aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>

                 <!-- </div>  -->
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
              <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                      <span>Copyright &copy; Learn<span style="color: coral; font-weight: 600;">Dash</span>Academy 2024</span>
                  </div>
              </div>
          </footer>
       
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>