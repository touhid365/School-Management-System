<!-- Footer -->
<?php include 'header.php' ?>
<!-- End of Footer -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Exam Details</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Download Report</a>
    </div>

    <!-- Exam Details Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Exams lists for Science Students</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Exam ID</th>
                            <th>Title</th>
                            <th>Marks</th>
                            <th>Question</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Database connection
                        $conn = mysqli_connect("localhost", "root", "", "students_db");

                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Fetch exam details
                        $sql = "SELECT * FROM exams WHERE exam_type = 'science'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>" . $row['id'] . "</td>
                                        <td>" . $row['title'] . "</td>
                                        <td>" . $row['total_marks'] . "</td>
                                        <td>" . $row['total_question'] . "</td>
                                        <td>" . $row['total_time'] . "</td>
                                        <td><a href='edit_exam.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                                            <a href='delete_exam.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirmDelete();'>Delete</a></td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No exams found</td></tr>";
                        }

                      
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!--Arts students--->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Exams list for Arts Students</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Exam ID</th>
                            <th>Title</th>
                            <th>Marks</th>
                            <th>Question</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Database connection
                        $conn = mysqli_connect("localhost", "root", "", "students_db");

                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Fetch exam details
                        $sql = "SELECT * FROM exams WHERE exam_type = 'Arts'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>" . $row['id'] . "</td>
                                        <td>" . $row['title'] . "</td>
                                        <td>" . $row['total_marks'] . "</td>
                                        <td>" . $row['total_question'] . "</td>
                                        <td>" . $row['total_time'] . "</td>
                                        <td><a href='edit_exam.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                                            <a href='delete_exam.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirmDelete();'>Delete</a></td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No exams found</td></tr>";
                        }

                      
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Display Exams for Arts Students -->
   
    <!-- End of Exam Details Table -->

</div>
<!-- /.container-fluid -->
 <!-- JavaScript for Confirm Delete -->
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this exam?");
}
</script>

<!-- End of Main Content -->

<!-- Footer -->
<?php include 'footer.php' ?>
<!-- End of Footer -->

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
