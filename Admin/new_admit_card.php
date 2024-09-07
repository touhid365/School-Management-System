<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> </a>
    </div>

    <!-- Handle Form Submission for Status Update -->
    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'students_db'); // Replace with your database credentials
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Ensure that both 'student_id' and 'status' are set
        if (isset($_POST['student_id']) && isset($_POST['status'])) {
            $student_id = $_POST['student_id'];
            $status = $_POST['status'];

            // Validate that student_id is an integer and status is a valid string
            if (is_numeric($student_id) && in_array($status, ['Pending', 'Passed', 'Failed'])) {
                // Update student status in the students table
                $update_query = "UPDATE students SET result = '$status' WHERE id = $student_id";

                if ($conn->query($update_query) === TRUE) {
                    echo "<div class='alert alert-success'>Status updated successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error updating status: " . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>Invalid input.</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>Required data not received.</div>";
        }
    }

    // Fetch students data from the database
    $query = "SELECT id, name, registration_id, result FROM students";
    $result = $conn->query($query);
    ?>

    <!-- Student Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Application Status</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Reg No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['registration_id']); ?></td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                                        <select name="status" style="padding: 5px; font-size: 15px; border: 1px solid #ccc; border-radius: 4px; width: 160px; background-color: #f8f9fa; color: #333; outline: none;" onchange="this.form.submit(); updateOptionColors(this);">
                                            <option value="Pending" <?php if ($row['result'] == 'Pending') echo 'selected'; ?> style="color: #9b7606;">Pending</option>
                                            <option value="Passed" <?php if ($row['result'] == 'Passed') echo 'selected'; ?> style="color: #0f7426;">Passed</option>
                                            <option value="Failed" <?php if ($row['result'] == 'Failed') echo 'selected'; ?> style="color: #97222e;">Failed</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- JavaScript to dynamically update colors -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selects = document.querySelectorAll('select[name="status"]');
        selects.forEach(select => updateOptionColors(select));
    });

    function updateOptionColors(select) {
        const option = select.options[select.selectedIndex];
        select.style.color = option.style.color;
    }
</script>

<!-- End of Main Content -->

<!-- Footer -->
<?php include 'footer.php'; ?>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
