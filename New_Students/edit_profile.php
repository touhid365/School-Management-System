                <!--- Header start --->
                <?php include 'header.php'; ?>
                <!-- End of Header -->
                
                <?php
                // Include database configuration file
                $servername = "localhost";
                $username = "root"; // Your MySQL username
                $password = ""; // Your MySQL password
                $dbname = "students_db";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                $message = '';

          
                if (isset($_POST['submit'])) {
                // Get form data
                $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $phone = mysqli_real_escape_string($conn, $_POST['mobile_no']);
                $maritalStatus = mysqli_real_escape_string($conn, $_POST['marital_status']);
                $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
                $gender = mysqli_real_escape_string($conn, $_POST['gender']);
                

                // SQL query to update the data
                $sql = "UPDATE students 
                SET name = '$fullName',
                email = '$email', 
                mobile_no = '$phone',
                m_status = '$maritalStatus',
                nation = '$nationality',
                gender = '$gender'
                WHERE id = '$students_id'";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                $message = '<div class="alert alert-success">Profile updated successfully!</div>';
                } else {
                $message = '<div class="alert alert-danger">Error updating profile: ' . mysqli_error($conn) . '</div>';
                }

                // Handle the image upload
                if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $update_image = $_FILES['profile_image']['name'];
                $update_image_size = $_FILES['profile_image']['size'];
                $update_image_tmp_name = $_FILES['profile_image']['tmp_name'];
                $update_image_folder = 'uploads/' . $update_image;

                if ($update_image_size > 2000000) {
                $message = '<div class="alert alert-danger">Image is too large!</div>';
                } else {
                $image_update_query = mysqli_query($conn, "UPDATE `students` SET profile_image = '$update_image' WHERE id = '$students_id'") or die('Query failed');
                if ($image_update_query) {
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
                $message = '<div class="alert alert-success">Image updated successfully!</div>';
               }
             }
            } else {
            // Handle cases where no file is uploaded
            $message = '<div class="alert alert-warning">No image uploaded or an error occurred.</div>';
          }
        }
    ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="container">
                        <div class="row gutters">
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="card h-100" style="box-shadow: 0 0 0 0.1rem rgba(78, 115, 223, 0.25);">
                            <div class="card-body">
                            <?php if (!empty($message)) echo $message; ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-2 text-primary">Personal Details</h6>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" name="fullName" id="fullName" value="<?php echo htmlspecialchars($row['name']); ?>"  placeholder="Enter full name" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="eMail">Email</label>
                                            <input type="email" class="form-control" name="email" id="eMail" value="<?php echo htmlspecialchars($row['email']); ?>" placeholder="Enter email ID" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="mobile_no" value="<?php echo htmlspecialchars($row['mobile_no']); ?>" placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="website">Registration No</label>
                                            <input type="text" class="form-control" id="registration_id" value="<?php echo htmlspecialchars($row['registration_id']); ?>" placeholder="Registration No" disabled>
                                        </div>
                                    </div>
                                   
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="website">Gender</label>
                                            <input type="text" class="form-control" id="gender" name="gender" value="<?php echo htmlspecialchars($row['gender']); ?>" placeholder=" Enter Gender" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="website">Marital Status</label>
                                            <input type="text" class="form-control" name="marital_status" id="marital_status" value="<?php echo htmlspecialchars($row['m_status']); ?>" placeholder="Enter your Status" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="website">Nationality</label>
                                            <input type="text" class="form-control" name="nationality" id="nationality" value="<?php echo htmlspecialchars($row['nation']); ?>" placeholder="Enter your Nationality" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mt-3 mb-2 text-primary">Profile Image</h6>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="profile_image">Image</label>
                                            <input type="file" class="form-control" name="profile_image" id="profile_image"  placeholder="image........" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right">
                                            <a href="profile.php" type="button" id="submit" name="back" class="btn btn-secondary">Cancel</a>
                                            <button type="submit"  name="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>

                </div>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>