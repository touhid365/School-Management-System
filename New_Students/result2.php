<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> </a>
    </div>

    <!-- Results Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Results</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="resultsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Reg No</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = new mysqli('localhost', 'root', '', 'students_db');

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch results data from the database
                        $resultQuery = "SELECT name, registration_id, result FROM students"; // Adjust query and table name as needed
                        $resultFetch = mysqli_query($conn, $resultQuery);

                        if ($resultFetch) {
                            if (mysqli_num_rows($resultFetch) > 0) {
                                while ($resultRows = mysqli_fetch_assoc($resultFetch)) {
                                    // Determine the content to display in the result column
                                    switch ($resultRows['result']) {
                                        case 'Passed':
                                            $status = '<a href="#" class="btn btn-success btn-sm m-2" style="cursor: default">Passed</a>';
                                            $viewButton = "<a href='result.php?reg_no=" . urlencode($resultRows['registration_id']) . "' class='btn btn-primary btn-sm'>View result</a>";
                                            break;
                                        case 'Failed':
                                            $status = '<a href="#" class="btn btn-danger btn-sm m-2" style="cursor: default">Failed</a>';
                                            $viewButton = "";
                                            break;
                                        case 'Pending':
                                        default:
                                            $status = '<a href="#" class="btn btn-warning btn-sm m-2" style="cursor: default">Pending</a>';
                                            $viewButton = "";
                                            break;
                                    }

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($resultRows['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($resultRows['registration_id']) . "</td>";
                                    echo "<td>" . $status . " " . $viewButton . "</td>"; // Display status and view button
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No results found</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Error: " . mysqli_error($conn) . "</td></tr>";
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<!-- Footer -->
<?php include 'footer.php'; ?>
<!-- End of Footer -->

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
