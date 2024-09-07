<!--- Header start --->
<?php include 'header.php'; ?>
<!-- End of Header -->
                

<?php
// Include database configuration file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

function generateTeacherID($conn) {
    do {
        // Generate a random 8-character alphanumeric ID
        $random_id = substr(str_shuffle("0123456789"), 0, 5);
        // Prefix the ID with "TCH"
        $teacher_id = "TCH" . $random_id;
        // Check if the generated ID already exists
        $id_check_sql = "SELECT * FROM teachers WHERE teacher_id = '$teacher_id'";
        $id_check_result = mysqli_query($conn, $id_check_sql);
    } while (mysqli_num_rows($id_check_result) > 0);

    return $teacher_id;
}

function generatePassword($length = 8) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789()';
    return substr(str_shuffle($chars), 0, $length);
}

if (isset($_POST['submit'])) {
    // Get form data
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['mobile_no']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $maritalStatus = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);

    // Check if email already exists
    $email_check_sql = "SELECT * FROM teachers WHERE email = '$email'";
    $email_check_result = mysqli_query($conn, $email_check_sql);

    if (mysqli_num_rows($email_check_result) > 0) {
        $message = '<div class="alert alert-danger">Email already exists!</div>';
    } else {
        // Generate unique teacher ID with prefix
        $teacher_id = generateTeacherID($conn);

        $password = generatePassword();//password generate 

        // SQL query to insert the data
        $sql = "INSERT INTO teachers 
                (teacher_id, fullName, email, mobile_no, role, gender, marital_status, nationality, address, city, state, zip, password)
                VALUES ('$teacher_id', '$fullName', '$email', '$phone', '$role', '$gender', '$maritalStatus', '$nationality', '$street', '$city', '$state', '$zip', '$password')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            $message = '<div class="alert alert-success">Teacher added successfully!</div>';

            // Handle the image upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $update_image = $_FILES['profile_image']['name'];
                $update_image_size = $_FILES['profile_image']['size'];
                $update_image_tmp_name = $_FILES['profile_image']['tmp_name'];
                $update_image_folder = 'uploads/' . $update_image;

                if ($update_image_size > 2000000) {
                    $message = '<div class="alert alert-danger">Image is too large!</div>';
                } else {
                    // Move the uploaded image to the folder
                    if (move_uploaded_file($update_image_tmp_name, $update_image_folder)) {
                        // Update the teacher record with the image path
                        $update_image_query = "UPDATE teachers SET profile_image = '$update_image' WHERE teacher_id = '$teacher_id'";
                        if (mysqli_query($conn, $update_image_query)) {
                            $message = '<div class="alert alert-success">Image uploaded and updated successfully!</div>';
                        } else {
                            $message = '<div class="alert alert-danger">Error updating image path in database!</div>';
                        }
                    } else {
                        $message = '<div class="alert alert-danger">Error uploading image!</div>';
                    }
                }
            } else {
                $message = '<div class="alert alert-warning">No image uploaded or an error occurred.</div>';
            }

            // Send email with login details
            $subject = "Your Account Details";
            $body = "Hello $fullName,\n\nYour account has been created. Here are your login details:\n\nTeacher ID: $teacher_id\nPassword: $password\n\nPlease login and change your password.\n\nBest regards,\nLearnDash Academy";
            $headers = "From: no-reply@yourdomain.com";

            if (mail($email, $subject, $body, $headers)) {
                $message .= '<div class="alert alert-success">Login details sent to your email!</div>';
            } else {
                $message .= '<div class="alert alert-danger">Failed to send email!</div>';
            }
        } else {
            $message = '<div class="alert alert-danger">Error creating profile: ' . mysqli_error($conn) . '</div>';
        }
    }
}
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="container">
                        <div class="row gutters">
                        <!-- <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12"> --
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="user-avatar">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                                        </div>
                                        <h5 class="user-name">Yuki Hayashi</h5>
                                        <h6 class="user-email">yuki@Maxwell.com</h6>
                                    </div>
                                    <div class="about">
                                        <h5>About</h5>
                                        <p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                         </div> -->
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="card h-100"  style="box-shadow: 0 0 0 0.1rem rgba(78, 115, 223, 0.25);">
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
                                            <input type="text" class="form-control" name="fullName" id="fullName"  placeholder="Enter full name" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="eMail">Email</label>
                                            <input type="email" class="form-control" name="email" id="eMail"  placeholder="Enter email ID" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="mobile_no"  placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="website">Roll No</label>
                                            <input type="text" class="form-control" id="roll_number"  placeholder="Enter" required>
                                        </div>
                                    </div> -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="website">Role</label>
                                            <input type="text" class="form-control" id="role" name="role"  placeholder="Enter role as a Teacher" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="website">Gender</label>
                                            <input type="text" class="form-control" id="gender" name="gender"  placeholder=" Enter Gender" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="website">Marital Status</label>
                                            <input type="text" class="form-control" name="marital_status" id="marital_status"  placeholder="Unmarried" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="website">Nationality</label>
                                            <input type="text" class="form-control" name="nationality" id="nationality"  placeholder="India" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mt-3 mb-2 text-primary">Address</h6>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="Street">Street</label>
                                            <input type="name" class="form-control" name="street" id="Street"  placeholder="Enter Street" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="ciTy">City</label>
                                            <input type="name" class="form-control" name="city" id="ciTy"  placeholder="Enter City" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="sTate">State</label>
                                            <input type="text" class="form-control" name="state" id="sTate" placeholder="Enter State" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="zIp">Zip Code</label>
                                            <input type="text" class="form-control" name="zip" id="zIp"  placeholder="Zip Code" required>
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
                                            <a href="View_profile.php" type="button" id="submit" name="back" class="btn btn-secondary">Cancel</a>
                                            <button type="submit"  name="submit" class="btn btn-success">Add Teacher</button>
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