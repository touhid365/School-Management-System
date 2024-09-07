                <!--- Header start --->
                <?php include 'header.php'; ?>
                <!-- End of Header -->

                <!-- Begin Page Content -->
                <!-- <div class="container-fluid">  -->

                    <!-- Page Heading -->
                    <section style="background: #f8f9fc;">
                        <div class="container py-5">
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="card mb-4" style="box-shadow: 0 0 0 0.1rem rgba(78, 115, 223, 0.25);">
                                <div class="card-body text-center">
                                  <?php
                                  if($row['profile_image'] == ''){
                                  echo '<img src="../images/school.png" class="rounded-circle img-fluid" style="width: 150px;">';
                                  }else{
                                  echo '<img src="uploads/'.$row['profile_image'].'" class="rounded-circle img-fluid" style="width: 150px;">';
                                  }
                                  ?>
                                  <h5 class="my-3">Admin</h5>
                                  <p class="text-muted mb-1">Username: <?php echo htmlspecialchars($row['name']); ?></p>
                                  
                                  <div class="d-flex justify-content-center mb-2" style="gap: 5px;">
                                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>
                                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
                                  </div>
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
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($row['name']); ?> </p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($row['email']); ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Phone</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($row['mobile']); ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Mobile</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><?php echo htmlspecialchars($row['mobile']); ?></p>
                                    </div>
                                  </div>
                                  <hr>
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